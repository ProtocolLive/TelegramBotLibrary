<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblTraits;
use ProtocolLive\TelegramBotLibrary\TblEnums\TblError;
use ProtocolLive\TelegramBotLibrary\TblObjects\{
  TblEntities,
  TblException,
  TblMarkup,
  TblTextEditMulti,
  TblTextSendMulti
};
use ProtocolLive\TelegramBotLibrary\TelegramBotLibrary;
use ProtocolLive\TelegramBotLibrary\TgEnums\{
  TgError,
  TgMethods,
  TgParseMode
};
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgDice,
  TgLimits,
  TgText
};
use ProtocolLive\TelegramBotLibrary\TgParams\{
  TgLinkPreview,
  TgReplyParams,
  TgSuggestedPostParameters
};

/**
 * @version 2026.01.05.00
 */
trait TblTextTrait{
  /**
   * Use this method to send an animated emoji that will display a random value.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param string $Emoji Emoji on which the dice throw animation is based. Currently, must be one of “🎲”, “🎯”, “🏀”, “⚽”, “🎳”, or “🎰”. Dice can have values 1-6 for “🎲”, “🎯” and “🎳”, values 1-5 for “🏀” and “⚽”, and values 1-64 for “🎰”. Defaults to “🎲”
   * @param int $Thread Unique identifier for the target message thread (topic) of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message will be sent
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param TgReplyParams $Reply If the message is a reply, ID of the original message
   * @param TblMarkup $Markup Additional interface options. A object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
   * @param string $Effect Unique identifier of the message effect to be added to the message; for private chats only
   * @param bool $AllowPaid Allow up to 1000 messages per second, ignoring broadcasting limits for a fee of 0.1 Telegram Stars per message. The relevant Stars will be withdrawn from the bot's balance
   * @param int $DirectTopic Identifier of the direct messages topic to which the message will be sent; required if the message is sent to a direct messages chat
   * @param TgSuggestedPostParameters $SuggestedPost A JSON-serialized object containing the parameters of the suggested post to send; for direct messages chats only. If the message is sent as a reply to another suggested post, then that suggested post is automatically declined.
   * @return TgText On success, the sent Message is returned.
   * @link https://core.telegram.org/bots/api#senddice
   */
  public function DiceSend(
    int|string $Chat,
    string|null $Emoji = null,
    int|null $Thread = null,
    string|null $BusinessId = null,
    int|null $DirectTopic = null,
    bool $DisableNotification = false,
    bool $Protect = false,
    bool $AllowPaid = false,
    TgReplyParams|null $Reply = null,
    TblMarkup|null $Markup = null,
    string|null $Effect = null,
    TgSuggestedPostParameters|null $SuggestedPost = null
  ):TgDice{
    $param['chat_id'] = $Chat;
    if($Thread !== null):
      $param['message_thread_id'] = $Thread;
    endif;
    if(empty($BusinessId) === false):
      $param['business_connection_id'] = $BusinessId;
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
    if($AllowPaid):
      $param['allow_paid_broadcast'] = true;
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
    if($DirectTopic !== null):
      $param['direct_messages_topic_id'] = $DirectTopic;
    endif;
    if($SuggestedPost !== null):
      $param['suggested_post_parameters'] = $SuggestedPost->ToArray();
    endif;
    return new TgDice($this->ServerMethod(TgMethods::DiceSend, $param));
  }

  /**
   * Use this method to stream a partial message to a user while the message is being generated; supported only for bots with forum topic mode enabled.
   * @param int $Chat Unique identifier for the target private chat
   * @param int $DaftId Unique identifier of the message draft; must be non-zero. Changes of drafts with the same identifier are animated
   * @param string $Text Text of the message to be sent, 1-4096 characters after entities parsing
   * @param int|null $Thread Unique identifier for the target message thread (topic) of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
   * @param TgParseMode|null $ParseMode Mode for parsing entities in the message text. See formatting options for more details.
   * @param TblEntities|null $Entities A JSON-serialized list of special entities that appear in message text, which can be specified instead of parse_mode
   * @return true
   * @throws TblException
   */
  public function DraftSend(
    int $Chat,
    int $DaftId,
    string $Text,
    int|null $Thread = null,
    TgParseMode|null $ParseMode = null,
    TblEntities|null $Entities = null
  ):true{
    if(mb_strlen(strip_tags($Text)) > TgLimits::Text):
      throw new TblException(
        TblError::LimitText,
        'Text exceed ' . TgLimits::Text . ' characters'
      );
    endif;
    if($DaftId < 1):
      throw new TblException(
        TgError::DraftId,
        'Draft id must be greater than 0'
      );
    endif;
    $param['chat_id'] = $Chat;
    $param['message_thread_id'] = $Thread;
    $param['draft_id'] = $DaftId;
    $param['text'] = $Text;
    if($ParseMode !== null):
      $param['parse_mode'] = $ParseMode->value;
    endif;
    if($Entities !== null):
      $param['entities'] = $Entities->ToArray();
    endif;
    return $this->ServerMethod(TgMethods::DraftSend, $param);
  }

  /**
   * Use this method to edit text and game messages.
   * @param int|string $Chat Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param int|null $Id Required if inline_message_id is not specified. Identifier of the message to edit
   * @param string $Text New text of the message, 1-4096 characters after entities parsing
   * @param string|null $InlineMessageId Required if chat_id and message_id are not specified. Identifier of the inline message
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message to be edited was sent
   * @param TgParseMode $ParseMode Mode for parsing entities in the message text.
   * @param TblEntities $Entities A list of special entities that appear in message text, which can be specified instead of parse_mode
   * @param TgLinkPreview $LinkPreview Link preview generation options for the message
   * @param TblMarkup $Markup A object for an inline keyboard.
   * @return TgText|true On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#editmessagetext
   */
  public function TextEdit(
    string $Text,
    int|string|null $Chat = null,
    int|null $Id = null,
    string|null $InlineMessageId = null,
    string|null $BusinessId = null,
    TgParseMode|null $ParseMode = null,
    TblEntities|null $Entities = null,
    TgLinkPreview|null $LinkPreview = null,
    TblMarkup|null $Markup = null
  ):TgText|true{
    $return = $this->ServerMethod(
      TgMethods::TextEdit,
      TblTextEditMulti::BuildArgs(
        Chat: $Chat,
        Text: $Text,
        Id: $Id,
        InlineMessageId: $InlineMessageId,
        BusinessId: $BusinessId,
        ParseMode: $ParseMode,
        Entities: $Entities,
        LinkPreview: $LinkPreview,
        Markup: $Markup
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
   * @param int $Thread Unique identifier for the target message thread (topic) of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message will be sent
   * @param TgParseMode $ParseMode Mode for parsing entities in the message text.
   * @param TblEntities $Entities A list of special entities that appear in message text, which can be specified instead of parse_mode
   * @param TgLinkPreview $LinkPreview Link preview generation options for the message
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param TgReplyParams $Reply If the message is a reply, ID of the original message
   * @param TblMarkup $Markup Additional interface options. A object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
   * @param string $Effect Unique identifier of the message effect to be added to the message; for private chats only
   * @param bool $AllowPaid Allow up to 1000 messages per second, ignoring broadcasting limits for a fee of 0.1 Telegram Stars per message. The relevant Stars will be withdrawn from the bot's balance
   * @param int $DirectTopic Identifier of the direct messages topic to which the message will be sent; required if the message is sent to a direct messages chat
   * @return TgText On success, the sent Message is returned.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#sendmessage
   */
  public function TextSend(
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
    string|null $Effect = null
  ):TgText{
    $return = $this->ServerMethod(
      TgMethods::TextSend,
      TblTextSendMulti::BuildArgs(
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
        Effect: $Effect,
        AllowPaid: $AllowPaid,
        DirectTopic: $DirectTopic
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