<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgSticker;

/**
 * This object describes the model of a unique gift.
 * @link https://core.telegram.org/bots/api#uniquegiftmodel
 * @version 2025.04.12.00
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
   * The number of unique gifts that receive this model for every 1000 gifts upgraded
   */
  public int $Rarity;

  public function __construct(
    array $Data
  ){
    $this->Name = $Data['name'];
    $this->Sticker = new TgSticker($Data['sticker']);
    $this->Rarity = $Data['rarity_per_mille'];
  }
}