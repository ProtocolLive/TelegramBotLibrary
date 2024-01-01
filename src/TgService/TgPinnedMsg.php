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
 * @link https://core.telegram.org/bots/api#photosize
 * @version 2024.01.01.02
 */
final class TgPinnedMsg
implements TgServiceInterface, TgEventInterface{
  public readonly TgMessageData $Data;
  public readonly TgMessageData $Pinned;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Pinned = new TgMessageData($Data['pinned_message']);
  }
}