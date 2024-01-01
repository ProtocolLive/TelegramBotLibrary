<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgService;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgServiceInterface;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgMessageData;

/**
 * @link https://core.telegram.org/bots/api#photosize
 * @version 2024.01.01.01
 */
final class TgPinnedMsg
implements TgServiceInterface{
  public readonly TgMessageData $Data;
  public readonly TgMessageData $Pinned;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Pinned = new TgMessageData($Data['pinned_message']);
  }
}