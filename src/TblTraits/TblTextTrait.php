<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.02.04.00

namespace ProtocolLive\TelegramBotLibrary\TblTraits;
use ProtocolLive\TelegramBotLibrary\TblObjects\{
  TblEntities,
  TblError,
  TblException,
  TblMarkup,
  TblTextSendMulti
};
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgLimits,
  TgMethods,
  TgParseMode,
  TgText
};

trait TblTextTrait{
  /**
   * Use this method to edit text and game messages.
   * @param int $Chat Required if inline_message_id is not specified. Unique identifier for the target chat
   * @param int $Id Required if inline_message_id is not specified. Identifier of the message to edit
   * @param string $Text New text of the message, 1-4096 characters after entities parsing
   * @param string $InlineId Required if chat_id and message_id are not specified. Identifier of the inline message
   * @param TgParseMode $ParseMode Mode for parsing entities in the message text.
   * @param TblEntities $Entities A list of special entities that appear in message text, which can be specified instead of parse_mode
   * @param bool $DisablePreview Disables link previews for links in this message
   * @param TblMarkup $Markup A object for an inline keyboard.
   * @return TgMessageData|bool On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#editmessagetext
   */
  public function TextEdit(
    int $Chat = null,
    int $Id = null,
    string $Text,
    string $InlineId = null,
    TgParseMode $ParseMode = null,
    TblEntities $Entities = null,
    bool $DisablePreview = false,
    TblMarkup $Markup = null
  ):TgText|bool{
    if(mb_strlen($Text) > TgLimits::Text):
      throw new TblException(TblError::LimitText);
    endif;
    if($Chat !== null):
      $param['chat_id'] = $Chat;
    endif;
    if($Id !== null):
      $param['message_id'] = $Id;
    endif;
    $param['text'] = $Text;
    if($InlineId !== null):
      $param['inline_message_id'] = $InlineId;
    endif;
    if($ParseMode !== null):
      $param['parse_mode'] = $ParseMode->value;
    endif;
    if($Entities !== null):
      $param['entities'] = $Entities->ToArray();
    endif;
    if($DisablePreview):
      $param['disable_web_page_preview'] = 'true';
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->ToArray();
    endif;
    $return = $this->ServerMethod(TgMethods::TextEdit, $param);
    if($return === true):
      return $return;
    else:
      return new TgText($return);
    endif;
  }

  /**
   * Use this method to send text messages for one or multiple chats. The Telegram API have some limits, but don't have a official docs for this.
   * @param int|array $Chat Unique identifier for the target chats
   * @param string $Text Text of the message to be sent, 1-4096 characters after entities parsing
   * @param int $Thread Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
   * @param TgParseMode $ParseMode Mode for parsing entities in the message text.
   * @param TblEntities $Entities A list of special entities that appear in message text, which can be specified instead of parse_mode
   * @param bool $DisablePreview Disables link previews for links in this message
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param int $RepliedMsg If the message is a reply, ID of the original message
   * @param bool $SendWithoutRepliedMsg Pass True, if the message should be sent even if the specified replied-to message is not found
   * @param array TblMarkup Additional interface options. A object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
   * @return TgText On success, the sent Message is returned.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#sendmessage
   */
  public function TextSend(
    int $Chat,
    string $Text,
    int $Thread = null,
    TgParseMode $ParseMode = null,
    TblEntities $Entities = null,
    bool $DisablePreview = false,
    bool $DisableNotification = false,
    bool $Protect = false,
    int $RepliedMsg = null,
    bool $SendWithoutRepliedMsg = false,
    TblMarkup $Markup = null
  ):TgText{
    $return = $this->ServerMethod(
      TgMethods::TextSend,
      TblTextSendMulti::BuildArgs(
        $Chat,
        $Text,
        $Thread,
        $ParseMode,
        $Entities,
        $DisablePreview,
        $DisableNotification,
        $Protect,
        $RepliedMsg,
        $SendWithoutRepliedMsg,
        $Markup
      )
    );
    return new TgText($return);
  }

  /**
   * Send text to many chats at once. Carefully with server limits.
   * https://core.telegram.org/bots/faq#my-bot-is-hitting-limits-how-do-i-avoid-this
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
      $Params
    );
    foreach($return as &$answer):
      if(is_object($answer) === false):
        $answer = new TgText($answer);
      endif;
    endforeach;
    return $return;
  }
}