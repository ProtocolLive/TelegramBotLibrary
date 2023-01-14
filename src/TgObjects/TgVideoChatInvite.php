<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.01.14.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#forumtopicclosed
 */
final class TgVideoChatInvite{
  public readonly TgMessageData $Data;
  public array $Users;

  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    foreach($$Data['video_chat_participants_invited']['users'] as $user):
      $this->Users[] = new TgUser($user);
    endforeach;
  }
}