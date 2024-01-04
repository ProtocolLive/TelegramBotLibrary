<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgChatType;

/**
 * @link https://core.telegram.org/bots/api#message
 * @version 2024.01.04.01
 */
final readonly class TgMessageData{
  /**
   * Unique message identifier inside this chat
   */
  public int $Id;
  /**
   * Sender of the message; empty for messages sent to channels. For backward compatibility, the field contains a fake sender user in non-channel chats, if the message was sent on behalf of a chat.
   */
  public TgUser|TgChat $User;
  /**
   * Sender of the message, sent on behalf of a chat. For example, the channel itself for channel posts, the supergroup itself for messages from anonymous group administrators, the linked channel for messages automatically forwarded to the discussion group. For backward compatibility, the field from contains a fake sender user in non-channel chats, if the message was sent on behalf of a chat.
   */
  public TgChat|TgUser $Chat;
  /**
   * Date the message was sent in Unix time
   */
  public int $Date;
  /**
   * If the message can't be forwarded
   */
  public bool $Protected;
  /**
   * For messages forwarded from channels or from anonymous administrators, information about the original sender chat
   */
  public TgUser|TgChat|string|null $ForwardFrom;
  /**
   * For messages forwarded from channels, identifier of the original message in the channel
   */
  public int|null $ForwardId;
  /**
   * If the message is a channel post that was automatically forwarded to the connected discussion group
   */
  public bool $ForwardAuto;
  /**
   * For forwarded messages, date the original message was sent in Unix time
   */
  public int|null $ForwardDate;
  /**
   * For messages originally sent by an anonymous chat administrator, original message author signature
   */
  public string|null $ForwardSignature;
  /**
   * For replies, the original message. Note that the Message object in this field will not contain further reply_to_message fields even if it itself is a reply.
   * Information about the message that is being replied to, which may come from another chat or forum topic
   */
  public TgText|TgPhoto|TgDocument|TgReplyExternal|null $Reply;
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

  //The bot 777000 is used to auto forward messages from channels to groups
  //The bot 1087968824 is used when admin post as the group and for migrate events
  //The bot 136817688 is used when admin post as channel
  public function __construct(
    array $Data
  ){
    $this->Id = $Data['message_id'];

    if(isset($Data['from'])
    and $Data['from']['id'] !== 777000
    and $Data['from']['id'] !== 1087968824
    and $Data['from']['id'] !== 136817688):
      $this->User = new TgUser($Data['from']);
    else:
      if($Data['sender_chat']['type'] === TgChatType::Channel->value
      or $Data['sender_chat']['type'] === TgChatType::GroupSuper->value):
        $this->User = new TgChat($Data['sender_chat']);
      else:
        $this->User = new TgUser($Data['sender']);
      endif;
    endif;

    if($Data['chat']['type'] === TgChatType::Private->value):
      $this->Chat = new TgUser($Data['chat']);
    else:
      $this->Chat = new TgChat($Data['chat']);
    endif;

    if(isset($Data['forward_origin'])):
      if($Data['forward_origin']['type'] === 'user'):
        $this->ForwardFrom = new TgUser($Data['forward_origin']['sender_user']);
      elseif($Data['forward_origin']['type'] === TgChatType::Channel->value):
        $this->ForwardFrom = new TgChat($Data['forward_origin']['chat']);
      endif;
    else:
      $this->ForwardFrom = null;
    endif;
    $this->ForwardId = $Data['forward_origin']['message_id'] ?? null;
    $this->ForwardDate = $Data['forward_origin']['date'] ?? null;
    $this->ForwardSignature = $Data['forward_origin']['author_signature'] ?? null;
    $this->ForwardAuto = $Data['is_automatic_forward'] ?? false;

    $this->Date = $Data['date'];
    $this->Protected = $Data['has_protected_content'] ?? false;
    $this->Topic = $Data['is_topic_message'] ?? false;
    $this->Spoiler = $Data['has_media_spoiler'] ?? false;
    $this->Thread = $Data['message_thread_id'] ?? null;
    $this->Signature = $Data['author_signature'] ?? null;

    if(isset($Data['reply_to_message']['text'])):
      $this->Reply = new TgText($Data['reply_to_message']);
    elseif(isset($Data['reply_to_message']['photo'])):
      $this->Reply = new TgPhoto($Data['reply_to_message']);
    elseif(isset($Data['reply_to_message']['document'])):
      $this->Reply = new TgDocument($Data['reply_to_message']);
    elseif(isset($Data['external_reply'])):
      $this->Reply = new TgReplyExternal($Data['external_reply']);
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
      $this->Markup[] = $temp;
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
  }
}