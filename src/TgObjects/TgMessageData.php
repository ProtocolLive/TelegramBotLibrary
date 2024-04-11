<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\{
  TgForward,
  TgReplyExternal
};
use ProtocolLive\TelegramBotLibrary\TgEnums\TgChatType;

/**
 * @link https://core.telegram.org/bots/api#message
 * @version 2024.04.11.00
 */
final readonly class TgMessageData{
  /**
   * Unique message identifier inside this chat or unique identifier for the query. Can be null in case of TgGroupStatus. Can be the connection id in case of business connection
   */
  public int|string|null $Id;
  /**
   * Sender of the message; empty for messages sent to channels. For backward compatibility, the field contains a fake sender user in non-channel chats, if the message was sent on behalf of a chat. Can be null in case of anonymous reaction
   */
  public TgUser|TgChat|null $User;
  /**
   * Sender of the message, sent on behalf of a chat. For example, the channel itself for channel posts, the supergroup itself for messages from anonymous group administrators, the linked channel for messages automatically forwarded to the discussion group. For backward compatibility, the field from contains a fake sender user in non-channel chats, if the message was sent on behalf of a chat. Can be null in case of callback
   */
  public TgChat|TgUser|null $Chat;
  /**
   * Date the message was sent in Unix time. Can be null in case of callback
   */
  public int|null $Date;
  /**
   * If the message can't be forwarded
   */
  public bool $Protected;
  public TgForward|null $Forward;
  /**
   * For replies, the original message. Note that the Message object in this field will not contain further reply_to_message fields even if it itself is a reply.
   * Information about the message that is being replied to, which may come from another chat or forum topic
   */
  public TgReplyExternal|TgText|TgPhoto|TgAudio|TgDocument|TgVideo|TgVoice|TgSticker|TgVenue|TgLocation|TgVideoNote|TgPoll|TgContact|TgDice|null $Reply;
  /**
   * For replies that quote part of the original message, the quoted part of the message
   */
  public TgQuote|null $Quote;
  /**
   * If the message is sent to a forum topic
   */
  public bool $Topic;
  /**
   * Unique identifier of a message thread to which the message belongs; for supergroups only
   */
  public int|null $Thread;
  /**
   * If the message media is covered by a spoiler animation
   */
  public bool $Spoiler;
  /**
   * Inline keyboard attached to the message. login_url buttons are represented as ordinary url buttons.
   */
  public array $Markup;
  /**
   * Bot through which the message was sent
   */
  public TgBot|null $Via;
  /**
   * Signature of the post author for messages in channels, or the custom title of an anonymous group administrator
   */
  public string|null $Signature;
  /**
   * If the sender of the message boosted the chat, the number of boosts added by the user
   */
  public int $Boost;
  /**
   * Not implemented in production yet
   */
  public string|null $BusinessConnection;
  /**
   * If the message was sent by an implicit action, for example, as an away or a greeting business message, or as a scheduled message
   */
  public bool $Offline;

  public function __construct(
    array $Data
  ){
    //The bot 777000 is used to auto forward messages from channels to groups
    //The bot 1087968824 is used when admin post as the group and for migrate events
    //The bot 136817688 is used when admin post as channel
    if(isset($Data['from'])
    and $Data['from']['id'] !== 777000
    and $Data['from']['id'] !== 1087968824
    and $Data['from']['id'] !== 136817688):
      $this->User = new TgUser($Data['from']);
    elseif(isset($Data['user'])): //reaction
      $this->User = new TgUser($Data['user']);
    elseif(isset($Data['sender_chat'])):
      if($Data['sender_chat']['type'] === TgChatType::Channel->value
      or $Data['sender_chat']['type'] === TgChatType::GroupSuper->value):
        $this->User = new TgChat($Data['sender_chat']);
      else:
        $this->User = new TgUser($Data['sender']);
      endif;
    else:
      $this->User = null; //anonymous reaction
    endif;

    if(isset($Data['chat']) === false): //callback
      $this->Chat = null;
    elseif($Data['chat']['type'] === TgChatType::Private->value):
      $this->Chat = new TgUser($Data['chat']);
    else:
      $this->Chat = new TgChat($Data['chat']);
    endif;

    if(isset($Data['external_reply'])):
      $this->Reply = new TgReplyExternal($Data['external_reply']);
    elseif(isset($Data['reply_to_message']['text'])):
      $this->Reply = new TgText($Data['reply_to_message']);
    elseif(isset($Data['reply_to_message']['photo'])):
      $this->Reply = new TgPhoto($Data['reply_to_message']['photo']);
    elseif(isset($Data['reply_to_message']['audio'])):
      $this->Reply = new TgAudio($Data['reply_to_message']['audio']);
    elseif(isset($Data['reply_to_message']['document'])):
      $this->Reply = new TgDocument($Data['reply_to_message']['document']);
    elseif(isset($Data['reply_to_message']['video'])):
      $this->Reply = new TgVideo($Data['reply_to_message']['video']);
    elseif(isset($Data['reply_to_message']['voice'])):
      $this->Reply = new TgVoice($Data['reply_to_message']['voice']);
    elseif(isset($Data['reply_to_message']['sticker'])):
      $this->Reply = new TgSticker($Data['reply_to_message']['sticker']);
    elseif(isset($Data['reply_to_message']['venue'])):
      $this->Reply = new TgVenue($Data['reply_to_message']['venue']);
    elseif(isset($Data['reply_to_message']['location'])):
      $this->Reply = new TgLocation($Data['reply_to_message']['location']);
    elseif(isset($Data['reply_to_message']['video_note'])):
      $this->Reply = new TgVideoNote($Data['reply_to_message']['video_note']);
    elseif(isset($Data['reply_to_message']['poll'])):
      $this->Reply = new TgPoll($Data['reply_to_message']['poll']);
    elseif(isset($Data['reply_to_message']['contact'])):
      $this->Reply = new TgContact($Data['reply_to_message']['contact']);
    elseif(isset($Data['reply_to_message']['dice'])):
      $this->Reply = new TgDice($Data['reply_to_message']['dice']);
    else:
      $this->Reply = null;
    endif;

    if(isset($Data['reply_markup']['inline_keyboard'])):
      $temp = [];
      foreach($Data['reply_markup']['inline_keyboard'] as $line => $cols):
        foreach($cols as $col => $markup):
          if(isset($markup['callback_data'])):
            $temp[$line][$col] = new TgButtonCallback($markup);
          elseif(isset($markup['web_app'])):
            $temp[$line][$col] = new TgButtonWebapp($markup);
          endif;
        endforeach;
      endforeach;
      $this->Markup = $temp;
    endif;

    if(isset($Data['forward_origin'])):
      $this->Forward = new TgForward($Data); //no index because 'is_automatic_forward'
    else:
      $this->Forward = null;
    endif;
    if(isset($Data['via_bot'])):
      $this->Via = new TgBot($Data['via_bot']);
    else:
      $this->Via = null;
    endif;
    if(isset($Data['quote'])):
      $this->Quote = new TgQuote($Data['quote']);
    else:
      $this->Quote = null;
    endif;

    $this->Id = $Data['id'] ?? $Data['message_id'] ?? null;//$Data['id'] form Callback
    $this->Date = $Data['date'] ?? null; //callback
    $this->Protected = $Data['has_protected_content'] ?? false;
    $this->Topic = $Data['is_topic_message'] ?? false;
    $this->Spoiler = $Data['has_media_spoiler'] ?? false;
    $this->Thread = $Data['message_thread_id'] ?? null;
    $this->Signature = $Data['author_signature'] ?? null;
    $this->Boost = $Data['sender_boost_count'] ?? 0;
    $this->BusinessConnection = $Data['business_connection_id'] ?? null;
    $this->Offline = $Data['is_from_offline'] ?? false;
  }
}