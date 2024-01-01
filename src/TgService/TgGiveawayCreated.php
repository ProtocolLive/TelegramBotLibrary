<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgService;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgServiceInterface;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgMessageData;

/**
 * @link https://core.telegram.org/bots/api#giveawaycreated
 * @version 2024.01.01.01
 */
final class TgGiveawayCreated
implements TgServiceInterface{
  public readonly TgMessageData $Data;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
  }
}