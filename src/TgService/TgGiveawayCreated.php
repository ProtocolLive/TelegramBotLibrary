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
 * @link https://core.telegram.org/bots/api#giveawaycreated
 * @version 2024.01.01.02
 */
final class TgGiveawayCreated
implements TgServiceInterface, TgEventInterface{
  public readonly TgMessageData $Data;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
  }
}