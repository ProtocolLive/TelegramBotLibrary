<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgGiftUniqueModelRarity;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgSticker;

/**
 * This object describes the model of a unique gift.
 * @link https://core.telegram.org/bots/api#uniquegiftmodel
 * @version 2026.02.27.00
 */
final readonly class TgGiftUniqueModel{
  /**
   * Name of the model
   */
  public string $Name;
  /**
   * The sticker that represents the unique gift
   */
  public TgSticker $Sticker;
  /**
   * The number of unique gifts that receive this model for every 1000 gift upgrades. Always 0 for crafted gifts.
   */
  public int $RarityMile;
  /**
   * Rarity of the model if it is a crafted model. Currently, can be “uncommon”, “rare”, “epic”, or “legendary”.
   */
  public TgGiftUniqueModelRarity|null $Rarity;

  public function __construct(
    array $Data
  ){
    $this->Name = $Data['name'];
    $this->Sticker = new TgSticker($Data['sticker']);
    $this->RarityMile = $Data['rarity_per_mile'];
    $this->Rarity = TgGiftUniqueModelRarity::tryFrom($Data['rarity'] ?? null);
  }
}