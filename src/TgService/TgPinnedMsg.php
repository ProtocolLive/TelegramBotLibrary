<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgServiceInterface;

/**
 * @link https://core.telegram.org/bots/api#photosize
 * @version 2023.05.23.00
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