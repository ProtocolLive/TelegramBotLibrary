<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgService;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgServiceInterface
};
use ProtocolLive\TelegramBotLibrary\TgObjects\TgMessageData;

/**
 * @link https://core.telegram.org/bots/api#forumtopicclosed
 * @version 2024.01.01.01
 */
final class TgVideoChatScheduled
implements TgServiceInterface, TgEventInterface{
  public readonly TgMessageData $Data;
  public readonly int $Start;

  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    $this->Start = $Data['video_chat_scheduled']['start_date'];
  }
}