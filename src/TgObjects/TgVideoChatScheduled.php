<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.01.14.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#forumtopicclosed
 */
final class TgVideoChatScheduled{
  public readonly TgMessageData $Data;
  public readonly int $Start;

  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    $this->Start = $Data['video_chat_scheduled']['start_date'];
  }
}