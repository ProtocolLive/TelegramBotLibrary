<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * This object represents a gift that can be sent by the bot.
 * @link https://core.telegram.org/bots/api#gift
 * @version 2025.08.15.00
 */
final readonly class TgGift{
  /**
   * Unique identifier of the gift
   */
  public string $Id;
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
  /**
   * The number of Telegram Stars that must be paid to upgrade the gift to a unique one
   */
  public int|null $Upgrade;
  /**
   * The sticker that represents the gift
   */
  public TgSticker $Sticker;
  /**
   * Information about the chat that published the gift
   */
  public TgChat|null $Chat;

  public function __construct(
    array $Data
  ){
    $this->Id = $Data['id'];
    $this->Sticker = new TgSticker($Data);
    $this->Price = $Data['star_count'];
    $this->Count = $Data['total_count'] ?? null;
    $this->Remaining = $Data['remaining_count'] ?? null;
    $this->Upgrade = $Data['upgrade_star_count'] ?? null;
    if($Data['publisher_chat'] !== null):
      $this->Chat = new TgChat($Data['publisher_chat']);
    else:
      $this->Chat = null;
    endif;
  }
}