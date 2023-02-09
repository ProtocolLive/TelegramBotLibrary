<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.02.09.00

namespace ProtocolLive\TelegramBotLibrary\TblTraits;
use ProtocolLive\TelegramBotLibrary\TblObjects\{
  TblEntities,
  TblException,
  TblMarkup,
  TblTextEditMulti,
  TblTextSendMulti
};
use ProtocolLive\TelegramBotLibrary\TelegramBotLibrary;
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgMessageData,
  TgMethods,
  TgParseMode,
  TgText
};

trait TblTextTrait{
  /**
   * Use this method to edit text and game messages.
   * @param int|string $Chat Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
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
    int|string $Chat = null,
    int $Id = null,
    string $Text,
    string $InlineId = null,
    TgParseMode $ParseMode = null,
    TblEntities $Entities = null,
    bool $DisablePreview = false,
    TblMarkup $Markup = null
  ):TgText|bool{
    $return = $this->ServerMethod(
      TgMethods::TextEdit,
      TblTextEditMulti::BuildArgs(
        $Chat,
        $Id,
        $Text,
        $InlineId,
        $ParseMode,
        $Entities,
        $DisablePreview,
        $Markup
      )
    );
    $return = $this->ServerMethod(TgMethods::TextEdit, $return);
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
   * @param TgParseMode $ParseMode Mode for parsing entities in the message text.
   * @param TblEntities $Entities A list of special entities that appear in message text, which can be specified instead of parse_mode
   * @param bool $DisablePreview Disables link previews for links in this message
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param int $RepliedMsg If the message is a reply, ID of the original message
   * @param bool $SendWithoutRepliedMsg Pass True, if the message should be sent even if the specified replied-to message is not found
   * @param TblMarkup TblMarkup Additional interface options. A object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
   * @return TgText On success, the sent Message is returned.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#sendmessage
   */
  public function TextSend(
    int|string $Chat,
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