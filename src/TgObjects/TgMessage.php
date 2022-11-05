<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.11.05.01

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

class TgMessage{
  public readonly int $Id;
  public readonly TgUser|TgChat $User;
  public readonly TgChat $Chat;
  public readonly int $Date;
  public readonly bool $Protected;
  public readonly TgUser|TgChat|null $ForwardFrom;
  public readonly int|null $ForwardId;
  public readonly bool|null $ForwardAuto;
  public readonly int|null $ForwardDate;
  public readonly TgText|TgPhoto|TgDocument|null $Reply;
  public readonly bool $Topic;
  public readonly int|null $TopicId;

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
    $this->Chat = new TgChat($Data['chat']);
    $this->Date = $Data['date'];
    $this->ForwardDate = $Data['forward_date'] ?? null;
    $this->Protected = $Data['has_protected_content'] ?? false;
    $this->Topic = $Data['is_topic_message'] ?? false;
    $this->TopicId = $Data['message_thread_id'] ?? null;
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
  }
}