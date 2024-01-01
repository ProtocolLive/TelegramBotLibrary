<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgService;
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgMessageData,
  TgObject
};

/**
 * @link https://core.telegram.org/bots/api#forumtopicclosed
 * @version 2024.01.01.00
 */
final class TgVideoChatEnded
extends TgObject{
  public readonly TgMessageData $Data;
  public readonly int $Duration;

  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    $this->Duration = $Data['video_chat_ended']['duration'];
  }
}