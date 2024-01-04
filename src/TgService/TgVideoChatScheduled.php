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
 * @version 2024.01.04.00
 */
final readonly class TgVideoChatScheduled
implements TgEventInterface, TgServiceInterface{
  public TgMessageData $Data;
  public int $Start;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Start = $Data['video_chat_scheduled']['start_date'];
  }
}