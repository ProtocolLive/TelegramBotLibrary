<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TblEnums\TblError;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgParseMode;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgLimits;
use ProtocolLive\TelegramBotLibrary\TgParams\{
  TgLinkPreview,
  TgReplyParams,
  TgSuggestedPostParameters
};

/**
 * @version 2026.01.05.00
 */
final class TblTextSendMulti
extends TblServerMulti{
  /**
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param string $Text Text of the message to be sent, 1-4096 characters after entities parsing
   * @param int $Thread Unique identifier for the target message thread (topic) of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message will be sent
   * @param TgParseMode $ParseMode Mode for parsing entities in the message text. See formatting options for more details.
   * @param TblEntities $Entities A  list of special entities that appear in message text, which can be specified instead of parse_mode
   * @param TgLinkPreview $LinkPreview Link preview generation options for the message
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param TgReplyParams $Reply If the message is a reply, ID of the original message
   * @param TblMarkup $Markup Additional interface options. A object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
   * @param int $DirectTopic Identifier of the direct messages topic to which the message will be sent; required if the message is sent to a direct messages chat
   * @param TgSuggestedPostParameters $SuggestedPost A JSON-serialized object containing the parameters of the suggested post to send; for direct messages chats only. If the message is sent as a reply to another suggested post, then that suggested post is automatically declined.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#sendmessage
   */
  public function __construct(
    int|string|null $Chat = null,
    string|null $Text = null,
    int|null $Thread = null,
    string|null $BusinessId = null,
    int|null $DirectTopic = null,
    TgParseMode|null $ParseMode = null,
    TblEntities|null $Entities = null,
    TgLinkPreview|null $LinkPreview = null,
    bool $DisableNotification = false,
    bool $Protect = false,
    TgReplyParams|null $Reply = null,
    TblMarkup|null $Markup = null,
    string|null $MultiControl = null,
    TgSuggestedPostParameters|null $SuggestedPost = null
  ){
    if($Chat === null
    or $Text === null):
      return;
    endif;
    $this->Args[$MultiControl ?? $Chat] = self::BuildArgs(
      Chat: $Chat,
      Text: $Text,
      Thread: $Thread,
      BusinessId: $BusinessId,
      ParseMode: $ParseMode,
      Entities: $Entities,
      LinkPreview: $LinkPreview,
      DisableNotification: $DisableNotification,
      Protect: $Protect,
      Reply: $Reply,
      Markup: $Markup,
      DirectTopic: $DirectTopic,
      SuggestedPost: $SuggestedPost
    );
  }

  /**
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param string $Text Text of the message to be sent, 1-4096 characters after entities parsing
   * @param int $Thread Unique identifier for the target message thread (topic) of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message will be sent
   * @param TgParseMode $ParseMode Mode for parsing entities in the message text. See formatting options for more details.
   * @param TblEntities $Entities A list of special entities that appear in message text, which can be specified instead of parse_mode
   * @param TgLinkPreview $LinkPreview Link preview generation options for the message
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param TgReplyParams $Reply If the message is a reply, ID of the original message
   * @param TblMarkup $Markup Additional interface options. A object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
   * @param int $DirectTopic Identifier of the direct messages topic to which the message will be sent; required if the message is sent to a direct messages chat
   * @param TgSuggestedPostParameters $SuggestedPost A JSON-serialized object containing the parameters of the suggested post to send; for direct messages chats only. If the message is sent as a reply to another suggested post, then that suggested post is automatically declined.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#sendmessage
   */
  public function Add(
    int|string $Chat,
    string $Text,
    int|null $Thread = null,
    string|null $BusinessId = null,
    int|null $DirectTopic = null,
    TgParseMode|null $ParseMode = null,
    TblEntities|null $Entities = null,
    TgLinkPreview|null $LinkPreview = null,
    bool $DisableNotification = false,
    bool $Protect = false,
    TgReplyParams|null $Reply = null,
    TblMarkup|null $Markup = null,
    TgSuggestedPostParameters|null $SuggestedPost = null,
    string|null $MultiControl = null
  ):void{
    $this->Args[$MultiControl ?? $Chat] = self::BuildArgs(
      Chat: $Chat,
      Text: $Text,
      Thread: $Thread,
      BusinessId: $BusinessId,
      ParseMode: $ParseMode,
      Entities: $Entities,
      LinkPreview: $LinkPreview,
      DisableNotification: $DisableNotification,
      Protect: $Protect,
      Reply: $Reply,
      Markup: $Markup,
      DirectTopic: $DirectTopic,
      SuggestedPost: $SuggestedPost
    );
  }

  /**
   * Use this method with TextSendMulti
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param string $Text Text of the message to be sent, 1-4096 characters after entities parsing
   * @param int $Thread Unique identifier for the target message thread (topic) of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message will be sent
   * @param TgParseMode $ParseMode Mode for parsing entities in the message text. See formatting options for more details.
   * @param TblEntities $Entities A list of special entities that appear in message text, which can be specified instead of parse_mode
   * @param TgLinkPreview $LinkPreview Link preview generation options for the message
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param TgReplyParams $Reply Description of the message to reply to
   * @param TblMarkup $Markup Additional interface options. A object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
   * @param string $Effect Unique identifier of the message effect to be added to the message; for private chats only
   * @param bool $AllowPaid Allow up to 1000 messages per second, ignoring broadcasting limits for a fee of 0.1 Telegram Stars per message. The relevant Stars will be withdrawn from the bot's balance
   * @param int $DirectTopic Identifier of the direct messages topic to which the message will be sent; required if the message is sent to a direct messages chat
   * @param TgSuggestedPostParameters $SuggestedPost A JSON-serialized object containing the parameters of the suggested post to send; for direct messages chats only. If the message is sent as a reply to another suggested post, then that suggested post is automatically declined.
   * @return array Prepared parameters for the TextSendMulti method
   * @throws TblException
   * @link https://core.telegram.org/bots/api#sendmessage
   */
  public static function BuildArgs(
    int|string $Chat,
    string $Text,
    int|null $Thread = null,
    string|null $BusinessId = null,
    int|null $DirectTopic = null,
    TgParseMode|null $ParseMode = null,
    TblEntities|null $Entities = null,
    TgLinkPreview|null $LinkPreview = null,
    bool $DisableNotification = false,
    bool $Protect = false,
    bool $AllowPaid = false,
    TgReplyParams|null $Reply = null,
    TblMarkup|null $Markup = null,
    string|null $Effect = null,
    TgSuggestedPostParameters|null $SuggestedPost = null
  ):array{
    if($Chat === null):
      throw new TblException(TblError::MissingParameter, 'Chat is required');
    endif;
    if($Text === ''):
      throw new TblException(TblError::MissingParameter, 'Text is required');
    endif;
    if(mb_strlen(strip_tags($Text)) > TgLimits::Text):
      throw new TblException(
        TblError::LimitText,
        'Text exceed ' . TgLimits::Text . ' characters'
      );
    endif;
    $param['chat_id'] = $Chat;
    if($ParseMode === TgParseMode::Markdown2):
      $Text = preg_replace('/([>#+\-={}.!])/', '\\\\$1', $Text);
    endif;
    $param['text'] = $Text;
    if(empty($BusinessId) === false):
      $param['business_connection_id'] = $BusinessId;
    endif;
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
    if($AllowPaid):
      $param['allow_paid_broadcast'] = true;
    endif;
    if($DirectTopic !== null):
      $param['direct_messages_topic_id'] = $DirectTopic;
    endif;
    if($SuggestedPost !== null):
      $param['suggested_post_parameters'] = $SuggestedPost->ToArray();
    endif;
    return $param;
  }

  public function Get(
    int $Id
  ):array{
    return $this->Args[$Id];
  }
}