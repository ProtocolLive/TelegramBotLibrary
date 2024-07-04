<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblTraits;
use ProtocolLive\TelegramBotLibrary\TblObjects\{
  TblEntities,
  TblException,
  TblMarkup
};
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgInputPollOptions;
use ProtocolLive\TelegramBotLibrary\TgEnums\{
  TgError,
  TgMethods,
  TgParseMode,
  TgPollType
};
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgLimits,
  TgPoll
};
use ProtocolLive\TelegramBotLibrary\TgParams\TgReplyParams;

/**
 * @version 2024.07.04.01
 */
trait TblPollTrait{
  /**
   * Use this method to send a native poll.
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message will be sent
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param int $ThreadId Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
   * @param string $Question Poll question, 1-300 characters
   * @param TgParseMode $ParseMode Mode for parsing entities in the question. See formatting options for more details. Currently, only custom emoji entities are allowed
   * @param TblEntities $Entities A list of special entities that appear in the poll question. It can be specified instead of question_parse_mode
   * @param TgInputPollOptions $Options A list of 2-10 answer options
   * @param bool $Anonymous If the poll needs to be anonymous, defaults to True
   * @param TgPollType $Type Poll type, “quiz” or “regular”, defaults to “regular”
   * @param bool $MultipleAnswers If the poll allows multiple answers, ignored for polls in quiz mode, defaults to False
   * @param int $CorrectOption 0-based identifier of the correct answer option, required for polls in quiz mode
   * @param string $Explanation Text that is shown when a user chooses an incorrect answer or taps on the lamp icon in a quiz-style poll, 0-200 characters with at most 2 line feeds after entities parsing
   * @param TgParseMode $ExplanationParseMode Mode for parsing entities in the explanation. See formatting options for more details.
   * @param TblEntities $ExplanationEntities A list of special entities that appear in the poll explanation. It can be specified instead of explanation_parse_mode
   * @param int $OpenPeriod Amount of time in seconds the poll will be active after creation, 5-600. Can't be used together with close_date.
   * @param int $CloseDate Point in time (Unix timestamp) when the poll will be automatically closed. Must be at least 5 and no more than 600 seconds in the future. Can't be used together with open_period.
   * @param bool $Closed If the poll needs to be immediately closed. This can be useful for poll preview.
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param string $Effect Unique identifier of the message effect to be added to the message; for private chats only
   * @param TgReplyParams $Reply Description of the message to reply to
   * @param TblMarkup $Markup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove a reply keyboard or to force a reply from the user
   * @return TgPoll The sent Message is returned.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#sendpoll
   */
  public function PollSend(
    int|string $Chat,
    string $Question,
    TgInputPollOptions $Options,
    int $ThreadId = null,
    string $BusinessId = null,
    TgParseMode $ParseMode = null,
    TblEntities $Entities = null,
    bool $Anonymous = false,
    TgPollType $Type = null,
    bool $MultipleAnswers = false,
    int $CorrectOption = null,
    string $Explanation = null,
    TgParseMode $ExplanationParseMode = null,
    TblEntities $ExplanationEntities = null,
    int $OpenPeriod = null,
    int $CloseDate = null,
    bool $Closed = false,
    bool $DisableNotification = false,
    bool $Protect = false,
    string $Effect = null,
    TgReplyParams $Reply = null,
    TblMarkup $Markup = null
  ):TgPoll{
    if(mb_strlen($Question) > TgLimits::PollQuestion):
      throw new TblException(
        TgError::LimitPollQuestion,
        'Question length exceeds ' . TgLimits::PollQuestion . ' characters'
      );
    endif;
    $Options->CheckMin();
    if($Explanation !== null
    and mb_strlen($Explanation) > TgLimits::PollExplanation):
      throw new TblException(
        TgError::LimitPollExplanation,
        'Explanation length exceeds ' . TgLimits::PollExplanation . ' characters'
      );
    endif;
    $param['chat_id'] = $Chat;
    $param['question'] = $Question;
    $param['options'] = $Options->ToArray();
    if($ThreadId !== null):
      $param['message_thread_id'] = $ThreadId;
    endif;
    if($BusinessId !== null):
      $param['business_connection_id'] = $BusinessId;
    endif;
    if($ParseMode !== null):
      $param['parse_mode'] = $ParseMode->value;
    endif;
    if($Entities !== null):
      $param['entities'] = $Entities->ToArray();
    endif;
    if($Anonymous):
      $param['is_anonymous'] = true;
    endif;
    if($Type !== null):
      $param['type'] = $Type->value;
    endif;
    if($MultipleAnswers):
      $param['allows_multiple_answers'] = true;
    endif;
    if($CorrectOption !== null):
      $param['correct_option_id'] = $CorrectOption;
    endif;
    if($Explanation !== null):
      $param['explanation'] = $Explanation;
    endif;
    if($ExplanationParseMode !== null):
      $param['explanation_parse_mode'] = $ExplanationParseMode->value;
    endif;
    if($ExplanationEntities !== null):
      $param['explanation_entities'] = $ExplanationEntities->ToArray();
    endif;
    if($OpenPeriod !== null):
      $param['open_period'] = $OpenPeriod;
    endif;
    if($CloseDate !== null):
      $param['close_date'] = $CloseDate;
    endif;
    if($Closed):
      $param['is_closed'] = true;
    endif;
    if($DisableNotification):
      $param['disable_notification'] = true;
    endif;
    if($Protect):
      $param['protect_content'] = true;
    endif;
    if($Effect !== null):
      $param['message_effect_id'] = $Effect;
    endif;
    if($Reply !== null):
      $param['reply_parameters'] = $Reply->ToArray();
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->ToArray();
    endif;
    return new TgPoll($this->ServerMethod(TgMethods::PollSend, $param));
  }

  /**
   * Use this method to stop a poll which was sent by the bot.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param int $Id Identifier of the original message with the poll
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message to be edited was sent
   * @param TblMarkup $Markup A object for a new message inline keyboard.
   * @return TgPoll The stopped Poll is returned.
   */
  public function PollStop(
    int|string $Chat,
    int $Id,
    string $BusinessId = null,
    TblMarkup $Markup = null
  ):TgPoll{
    $param['chat_id'] = $Chat;
    $param['message_id'] = $Id;
    if($BusinessId !== null):
      $param['business_connection_id'] = $BusinessId;
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->ToArray();
    endif;
    return new TgPoll($this->ServerMethod(TgMethods::PollStop, $param));
  }
}