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
 * @version 2025.06.17.00
 */
final readonly class TgGiftUniqueInfo
implements TgEventInterface,
TgServiceInterface{
  /**
   * Information about the gift
   */
  public TgGiftUnique $Gift;
  /**
   * Origin of the gift.
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
  

  public function __construct(
    array $Data
  ){
    $this->Gift = new TgGiftUnique($Data['gift']);
    $this->Origin = TgGiftUniqueOrigin::from($Data['origin']);
    $this->Id = $Data['owned_gift_id'] ?? null;
    $this->Stars = $Data['convert_star_count'] ?? null;
  }
}