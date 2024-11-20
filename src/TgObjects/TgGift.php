<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * This object represents a gift that can be sent by the bot.
 * @link https://core.telegram.org/bots/api#gift
 * @version 2014.11.20.00
 */
final readonly class TgGift{
  /**
   * Unique identifier of the gift
   */
  public string $Id;
  /**
   * The sticker that represents the gift
   */
  public TgSticker $Sticker;
  /**
   * The number of Telegram Stars that must be paid to send the sticker
   */
  public int $Price;
  /**
   * The total number of the gifts of this type that can be sent; for limited gifts only
   */
  public int|null $Count;
  /**
   * The number of remaining gifts of this type that can be sent; for limited gifts only
   */
  public int|null $Remaining;

  public function __construct(
    array $Data
  ){
    $this->Id = $Data['id'];
    $this->Sticker = new TgSticker($Data);
    $this->Price = $Data['star_count'];
    $this->Count = $Data['total_count'] ?? null;
    $this->Remaining = $Data['remaining_count'] ?? null;
  }
}