<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.12.30.03

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

class TgMessageData{
  /**
   * Unique message identifier inside this chat
   */
  public readonly int $Id;
  /**
   * Sender of the message; empty for messages sent to channels. For backward compatibility, the field contains a fake sender user in non-channel chats, if the message was sent on behalf of a chat.
   */
  public readonly TgUser|TgChat $User;
  /**
   * Sender of the message, sent on behalf of a chat. For example, the channel itself for channel posts, the supergroup itself for messages from anonymous group administrators, the linked channel for messages automatically forwarded to the discussion group. For backward compatibility, the field from contains a fake sender user in non-channel chats, if the message was sent on behalf of a chat.
   */
  public readonly TgChat|TgUser $Chat;
  /**
   * Date the message was sent in Unix time
   */
  public readonly int $Date;
  /**
   * If the message can't be forwarded
   */
  public readonly bool $Protected;
  /**
   * For messages forwarded from channels or from anonymous administrators, information about the original sender chat
   */
  public readonly TgUser|TgChat|null $ForwardFrom;
  /**
   * For messages forwarded from channels, identifier of the original message in the channel
   */
  public readonly int|null $ForwardId;
  /**
   * If the message is a channel post that was automatically forwarded to the connected discussion group
   */
  public readonly bool|null $ForwardAuto;
  /**
   * For forwarded messages, date the original message was sent in Unix time
   */
  public readonly int|null $ForwardDate;
  /**
   * For replies, the original message. Note that the Message object in this field will not contain further reply_to_message fields even if it itself is a reply.
   */
  public readonly TgText|TgPhoto|TgDocument|null $Reply;
  /**
   * If the message is sent to a forum topic
   */
  public readonly bool $Topic;
  /**
   * Unique identifier of a message thread to which the message belongs; for supergroups only
   */
  public readonly int|null $Thread;
  /**
   * If the message media is covered by a spoiler animation
   */
  public readonly bool $Spoiler;
  /**
   * Inline keyboard attached to the message. login_url buttons are represented as ordinary url buttons.
   */
  public array $Markup = [];

  //The bot 777000 is used to forward messages from channels to groups
  //The bot 1087968824 is used for admins post as the group and for migrate events
  public function __construct(array $Data){
    $this->Id = $Data['message_id'];
    if(($Data['from']['id'] ?? 0) === 777000): //Telegram
      $this->User = new TgChat($Data['sender_chat']);
      $this->ForwardFrom = new TgChat($Data['forward_from_chat']);
      $this->ForwardId = $Data['forward_from_message_id'];
      $this->ForwardAuto = $Data['is_automatic_forward'];
    elseif(($Data['from']['id'] ?? 0) === 1087968824): //GroupAnonymousBot
      $this->User = new TgChat($Data['sender_chat']);
      $this->ForwardFrom = null;
      $this->ForwardId = null;
      $this->ForwardAuto = null;
    else:
      if(isset($Data['from'])):
        $this->User = new TgUser($Data['from']);
      else:
        $this->User = new TgChat($Data['sender_chat']);
      endif;
      if(isset($Data['forward_from'])):
        $this->ForwardFrom = new TgUser($Data['forward_from']);
      else:
        $this->ForwardFrom = null;
      endif;
      $this->ForwardId = null;
      $this->ForwardAuto = null;
    endif;
    if($Data['chat']['type'] === TgChatType::Private->value):
      $this->Chat = new TgUser($Data['chat']);
    else:
      $this->Chat = new TgChat($Data['chat']);
    endif;
    $this->Date = $Data['date'];
    $this->ForwardDate = $Data['forward_date'] ?? null;
    $this->Protected = $Data['has_protected_content'] ?? false;
    $this->Topic = $Data['is_topic_message'] ?? false;
    $this->Spoiler = $Data['has_media_spoiler'] ?? false;
    $this->Thread = $Data['message_thread_id'] ?? null;
    if(isset($Data['reply_to_message']) === false):
      $this->Reply = null;
    else:
      if(isset($Data['reply_to_message']['text'])):
        $this->Reply = new TgText($Data['reply_to_message']);
      elseif(isset($Data['reply_to_message']['photo'])):
        $this->Reply = new TgPhoto($Data['reply_to_message']);
      elseif(isset($Data['reply_to_message']['document'])):
        $this->Reply = new TgDocument($Data['reply_to_message']);
      else:
        $this->Reply = null;
      endif;
    endif;
    if(isset($Data['reply_markup']['inline_keyboard'])):
      foreach($Data['reply_markup']['inline_keyboard'] as $line => $cols):
        foreach($cols as $col => $markup):
          if(isset($markup['callback_data'])):
            $this->Markup[$line][$col] = new TgButtonCallback($markup);
          elseif(isset($markup['web_app'])):
            $this->Markup[$line][$col] = new TgButtonWebapp($markup);
          endif;
        endforeach;
      endforeach;
    endif;
  }
}