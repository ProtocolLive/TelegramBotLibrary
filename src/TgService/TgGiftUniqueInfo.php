<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgService;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgGiftUnique;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgGiftUniqueOrigin;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgServiceInterface
};

/**
 * Describes a service message about a unique gift that was sent or received.
 * @link https://core.telegram.org/bots/api#uniquegiftinfo
 * @version 2025.07.04.00
 */
final readonly class TgGiftUniqueInfo
implements TgEventInterface,
TgServiceInterface{
  /**
   * Information about the gift
   */
  public TgGiftUnique $Gift;
  /**
   * Origin of the gift. Currently, either “upgrade” for gifts upgraded from regular gifts, “transfer” for gifts transferred from other users or channels, or “resale” for gifts bought from other users
   */
  public TgGiftUniqueOrigin $Origin;
  /**
   * Unique identifier of the received gift for the bot; only present for gifts received on behalf of business accounts
   */
  public string|null $Id;
  /**
   * Number of Telegram Stars that must be paid to transfer the gift; omitted if the bot cannot transfer the gift
   */
  public int|null $Stars;
  /**
   * Point in time (Unix timestamp) when the gift can be transferred. If it is in the past, then the gift can be transferred now
   */
  public int|null $TransferBefore;
  /**
   * For gifts bought from other users, the price paid for the gift
   */
  public float|null $PriceLast;
  

  public function __construct(
    array $Data
  ){
    $this->Gift = new TgGiftUnique($Data['gift']);
    $this->Origin = TgGiftUniqueOrigin::from($Data['origin']);
    $this->Id = $Data['owned_gift_id'] ?? null;
    $this->Stars = $Data['convert_star_count'] ?? null;
    $this->TransferBefore = $Data['next_transfer_date'] ?? null;
    $this->PriceLast = $Data['last_resale_star_count'] ?? null;
  }
}