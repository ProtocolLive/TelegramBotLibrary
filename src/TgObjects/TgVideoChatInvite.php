<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#forumtopicclosed
 * @version 2023.05.23.00
 */
final class TgVideoChatInvite
extends TgObject{
  public readonly TgMessageData $Data;
  public array $Users;

  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    foreach($$Data['video_chat_participants_invited']['users'] as $user):
      $this->Users[] = new TgUser($user);
    endforeach;
  }
}