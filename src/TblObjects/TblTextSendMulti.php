<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.02.07.00

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgLimits,
  TgParseMode
};

final class TblTextSendMulti
extends TblServerMulti{
  public function __construct(
    int $Chat = null,
    string $Text = null,
    int $Thread = null,
    TgParseMode $ParseMode = null,
    TblEntities $Entities = null,
    bool $DisablePreview = false,
    bool $DisableNotification = false,
    bool $Protect = false,
    int $RepliedMsg = null,
    bool $SendWithoutRepliedMsg = false,
    TblMarkup $Markup = null,
    string $MultiControl = null
  ){
    if($Chat === null
    or $Text === null):
      return;
    endif;
    $this->Args[$MultiControl ?? $Chat] = self::BuildArgs(
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
    );
  }

  public function Add(
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
    TblMarkup $Markup = null,
    string $MultiControl = null
  ):void{
    $this->Args[$MultiControl ?? $Chat] = self::BuildArgs(
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
      $Markup,
    );
  }

  /**
   * Use this method with TextSendMulti
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
   * @param TblMarkup $TblMarkup Additional interface options. A object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
   * @return array Prepared parameters for the TextSendMulti method
   * @link https://core.telegram.org/bots/api#sendmessage
   */
  public static function BuildArgs(
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
  ):array{
    if(mb_strlen(strip_tags($Text)) > TgLimits::Text):
      throw new TblException(TblError::LimitText, 'Text exceed ' . TgLimits::Text . ' characters');
    endif;
    $param['chat_id'] = $Chat;
    $param['text'] = $Text;
    if($Thread !== null):
      $param['message_thread_id'] = $Thread;
    endif;
    if($ParseMode !== null):
      $param['parse_mode'] = $ParseMode->value;
    endif;
    if($Entities !== null):
      $param['entities'] = $Entities->ToArray();
    endif;
    if($DisablePreview):
      $param['disable_web_page_preview'] = true;
    endif;
    if($DisableNotification):
      $param['disable_notification'] = true;
    endif;
    if($Protect):
      $param['protect_content'] = true;
    endif;
    if($RepliedMsg !== null):
      $param['reply_to_message_id'] = $RepliedMsg;
    endif;
    if($SendWithoutRepliedMsg):
      $param['allow_sending_without_reply'] = true;
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->ToArray();
    endif;
    return $param;
  }
}