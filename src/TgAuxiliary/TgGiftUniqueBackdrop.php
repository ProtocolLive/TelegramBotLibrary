<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;

/**
 * This object describes the backdrop of a unique gift.
 * @link https://core.telegram.org/bots/api#uniquegiftbackdrop
 * @version 2025.04.12.00
 */
final readonly class TgGiftUniqueBackdrop{
  /**
   * Name of the backdrop
   */
  public string $Name;
  /**
   * Colors of the backdrop
   */
  public TgGiftUniqueBackdropColors $Colors;
  /**
   * The number of unique gifts that receive this backdrop for every 1000 gifts upgraded
   */
  public int $Rarity;

  public function __construct(
    array $Data
  ){
    $this->Name = $Data['name'];
    $this->Colors = new TgGiftUniqueBackdropColors($Data['colors']);
    $this->Rarity = $Data['rarity_per_mille'];
  }
}