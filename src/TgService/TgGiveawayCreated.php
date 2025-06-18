<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgService;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgServiceInterface
};

/**
 * @link https://core.telegram.org/bots/api#giveawaycreated
 * @version 2025.06.17.00
 */
final readonly class TgGiveawayCreated
implements TgEventInterface,
TgServiceInterface{
  public TgMessageData $Data;
  /**
   * The number of Telegram Stars to be split between giveaway winners; for Telegram Star giveaways only
   */
  public int|null $Stars;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Stars = $Data['prize_star_count'] ?? null;
  }
}