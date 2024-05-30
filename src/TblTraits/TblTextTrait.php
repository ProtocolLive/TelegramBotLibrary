<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblTraits;
use ProtocolLive\TelegramBotLibrary\TblObjects\{
  TblEntities,
  TblException,
  TblMarkup,
  TblTextEditMulti,
  TblTextSendMulti
};
use ProtocolLive\TelegramBotLibrary\TelegramBotLibrary;
use ProtocolLive\TelegramBotLibrary\TgEnums\{
  TgMethods,
  TgParseMode
};
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgDice,
  TgText
};
use ProtocolLive\TelegramBotLibrary\TgParams\{
  TgLinkPreview,
  TgReplyParams
};

/**
 * @version 2024.05.30.00
 */
trait TblTextTrait{
  /**
   * Use this method to send an animated emoji that will display a random value.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param string $Emoji Emoji on which the dice throw animation is based. Currently, must be one of “🎲”, “🎯”, “🏀”, “⚽”, “🎳”, or “🎰”. Dice can have values 1-6 for “🎲”, “🎯” and “🎳”, values 1-5 for “🏀” and “⚽”, and values 1-64 for “🎰”. Defaults to “🎲”
   * @param int $Thread Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message will be sent
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param TgReplyParams $Reply If the message is a reply, ID of the original message
   * @param TblMarkup $Markup Additional interface options. A object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
   * @param string $Effect Unique identifier of the message effect to be added to the message; for private chats only
   * @return TgText On success, the sent Message is returned.
   * @link https://core.telegram.org/bots/api#senddice
   */
  public function DiceSend(
    int|string $Chat = null,
    string $Emoji = null,
    int $Thread = null,
    string $BusinessId = null,
    bool $DisableNotification = false,
    bool $Protect = false,
    TgReplyParams $Reply = null,
    TblMarkup $Markup = null,
    string $Effect = null
  ):TgDice{
    if($BusinessId !== null):
      $param['business_connection_id'] = $BusinessId;
    else:
      $param['chat_id'] = $Chat;
      if($Thread !== null):
        $param['message_thread_id'] = $Thread;
      endif;
    endif;
    if($Emoji !== null):
      $param['emoji'] = $Emoji;
    endif;
    if($DisableNotification):
      $param['disable_notification'] = true;
    endif;
    if($Protect):
      $param['protect_content'] = true;
    endif;
    if($Reply !== null):
      $param['reply_parameters'] = $Reply->ToArray();
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->ToArray();
    endif;
    if($Effect !== null):
      $param['message_effect_id'] = $Effect;
    endif;
    return new TgDice($this->ServerMethod(TgMethods::DiceSend, $param));
  }

  /**
   * Use this method to edit text and game messages.
   * @param int|string|null $Chat Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param int|null $Id Required if inline_message_id is not specified. Identifier of the message to edit
   * @param string $Text New text of the message, 1-4096 characters after entities parsing
   * @param string|null $InlineId Required if chat_id and message_id are not specified. Identifier of the inline message
   * @param TgParseMode $ParseMode Mode for parsing entities in the message text.
   * @param TblEntities $Entities A list of special entities that appear in message text, which can be specified instead of parse_mode
   * @param TgLinkPreview $LinkPreview Link preview generation options for the message
   * @param TblMarkup $Markup A object for an inline keyboard.
   * @return TgText|true On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#editmessagetext
   */
  public function TextEdit(
    int|string $Chat = null,
    int $Id = null,
    string $Text,
    string $InlineId = null,
    TgParseMode $ParseMode = null,
    TblEntities $Entities = null,
    TgLinkPreview $LinkPreview = null,
    TblMarkup $Markup = null
  ):TgText|true{
    $return = $this->ServerMethod(
      TgMethods::TextEdit,
      TblTextEditMulti::BuildArgs(
        $Chat,
        $Id,
        $Text,
        $InlineId,
        $ParseMode,
        $Entities,
        $LinkPreview,
        $Markup
      )
    );
    if($return === true):
      return true;
    else:
      return new TgText($return);
    endif;
  }

  /**
   * Edit text in many chats at once
   * @return TgText[]|TblException[]|bool[]
   */
  public function TextEditMulti(
    TblTextEditMulti $Params
  ):array{
    /**
     * @var TelegramBotLibrary $this
     */
    $return = $this->ServerMethodMulti(
      TgMethods::TextEdit,
      $Params->GetArray()
    );
    foreach($return as &$answer):
      if(is_object($answer) === false):
        $answer = new TgText($answer);
      endif;
    endforeach;
    return $return;
  }

  /**
   * Use this method to send text messages for one or multiple chats. The Telegram API have some limits, but don't have a official docs for this.
   * @param int|string $Chat Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param string $Text Text of the message to be sent, 1-4096 characters after entities parsing
   * @param int $Thread Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message will be sent
   * @param TgParseMode $ParseMode Mode for parsing entities in the message text.
   * @param TblEntities $Entities A list of special entities that appear in message text, which can be specified instead of parse_mode
   * @param TgLinkPreview $LinkPreview Link preview generation options for the message
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param TgReplyParams $Reply If the message is a reply, ID of the original message
   * @param TblMarkup $Markup Additional interface options. A object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
   * @param string $Effect Unique identifier of the message effect to be added to the message; for private chats only
   * @return TgText On success, the sent Message is returned.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#sendmessage
   */
  public function TextSend(
    int|string $Chat = null,
    string $Text,
    int $Thread = null,
    string $BusinessId = null,
    TgParseMode $ParseMode = null,
    TblEntities $Entities = null,
    TgLinkPreview $LinkPreview = null,
    bool $DisableNotification = false,
    bool $Protect = false,
    TgReplyParams $Reply = null,
    TblMarkup $Markup = null,
    string $Effect = null
  ):TgText{
    $return = $this->ServerMethod(
      TgMethods::TextSend,
      TblTextSendMulti::BuildArgs(
        $Chat,
        $Text,
        $Thread,
        $BusinessId,
        $ParseMode,
        $Entities,
        $LinkPreview,
        $DisableNotification,
        $Protect,
        $Reply,
        $Markup,
        $Effect
      )
    );
    return new TgText($return);
  }

  /**
   * Send text to many chats at once.
   * Carefully with server limits: https://core.telegram.org/bots/faq#my-bot-is-hitting-limits-how-do-i-avoid-this
   * @return TgText[]|TblException[]
   */
  public function TextSendMulti(
    TblTextSendMulti $Params
  ):array{
    /**
     * @var TelegramBotLibrary $this
     */
    $return = $this->ServerMethodMulti(
      TgMethods::TextSend,
      $Params->GetArray()
    );
    foreach($return as &$answer):
      if(is_object($answer) === false):
        $answer = new TgText($answer);
      endif;
    endforeach;
    return $return;
  }
}