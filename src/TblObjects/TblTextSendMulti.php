<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgParseMode;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgLimits;
use ProtocolLive\TelegramBotLibrary\TgParams\{
  TgLinkPreview,
  TgReplyParams
};

/**
 * @version 2024.07.03.00
 */
final class TblTextSendMulti
extends TblServerMulti{
  /**
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param string $Text Text of the message to be sent, 1-4096 characters after entities parsing
   * @param int $Thread Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message will be sent
   * @param TgParseMode $ParseMode Mode for parsing entities in the message text. See formatting options for more details.
   * @param TblEntities $Entities A  list of special entities that appear in message text, which can be specified instead of parse_mode
   * @param TgLinkPreview $LinkPreview Link preview generation options for the message
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param TgReplyParams $Reply If the message is a reply, ID of the original message
   * @param TblMarkup $Markup Additional interface options. A object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
   * @link https://core.telegram.org/bots/api#sendmessage
   */
  public function __construct(
    int|string $Chat = null,
    string $Text = null,
    int $Thread = null,
    string $BusinessId = null,
    TgParseMode $ParseMode = null,
    TblEntities $Entities = null,
    TgLinkPreview $LinkPreview = null,
    bool $DisableNotification = false,
    bool $Protect = false,
    TgReplyParams $Reply = null,
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
      $BusinessId,
      $ParseMode,
      $Entities,
      $LinkPreview,
      $DisableNotification,
      $Protect,
      $Reply,
      $Markup
    );
  }

  /**
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param string $Text Text of the message to be sent, 1-4096 characters after entities parsing
   * @param int $Thread Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message will be sent
   * @param TgParseMode $ParseMode Mode for parsing entities in the message text. See formatting options for more details.
   * @param TblEntities $Entities A list of special entities that appear in message text, which can be specified instead of parse_mode
   * @param TgLinkPreview $LinkPreview Link preview generation options for the message
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param TgReplyParams $Reply If the message is a reply, ID of the original message
   * @param TblMarkup $Markup Additional interface options. A object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
   * @link https://core.telegram.org/bots/api#sendmessage
   */
  public function Add(
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
    string $MultiControl = null
  ):void{
    $this->Args[$MultiControl ?? $Chat] = self::BuildArgs(
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
      $Markup
    );
  }

  /**
   * Use this method with TextSendMulti
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param string $Text Text of the message to be sent, 1-4096 characters after entities parsing
   * @param int $Thread Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message will be sent
   * @param TgParseMode $ParseMode Mode for parsing entities in the message text. See formatting options for more details.
   * @param TblEntities $Entities A list of special entities that appear in message text, which can be specified instead of parse_mode
   * @param TgLinkPreview $LinkPreview Link preview generation options for the message
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param TgReplyParams $Reply Description of the message to reply to
   * @param TblMarkup $Markup Additional interface options. A object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
   * @param string $Effect Unique identifier of the message effect to be added to the message; for private chats only
   * @return array Prepared parameters for the TextSendMulti method
   * @link https://core.telegram.org/bots/api#sendmessage
   */
  public static function BuildArgs(
    string $Text,
    int|string $Chat = null,
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
  ):array{
    if($Chat === null):
      throw new TblException(TblError::MissingParameter, 'Chat is required');
    endif;
    if($Text === null):
      throw new TblException(TblError::MissingParameter, 'Text is required');
    endif;
    if(mb_strlen(strip_tags($Text)) > TgLimits::Text):
      throw new TblException(TblError::LimitText, 'Text exceed ' . TgLimits::Text . ' characters');
    endif;
    if($BusinessId !== null):
      $param['business_connection_id'] = $BusinessId;
    else:
      $param['chat_id'] = $Chat;
    endif;
    if($ParseMode === TgParseMode::Markdown2):
      $Text = preg_replace('/([>#+\-={}.!])/', '\\\\$1', $Text);
    endif;
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
    if($LinkPreview !== null):
      $param['link_preview_options'] = $LinkPreview->ToArray();
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
    return $param;
  }

  public function Get(
    int $Id
  ):array{
    return $this->Args[$Id];
  }
}