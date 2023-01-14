<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.01.14.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#forumtopicclosed
 */
final class TgVideoChatEnded{
  public readonly TgMessageData $Data;
  public readonly int $Duration;

  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    $this->Duration = $Data['video_chat_ended']['duration'];
  }
}