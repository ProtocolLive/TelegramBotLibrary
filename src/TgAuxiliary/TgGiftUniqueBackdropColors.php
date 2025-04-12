<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;

/**
 * This object describes the colors of the backdrop of a unique gift.
 * @link https://core.telegram.org/bots/api#uniquegiftbackdropcolors
 * @version 2025.04.12.00
 */
final readonly class TgGiftUniqueBackdropColors{
  /**
   * The color in the center of the backdrop in RGB format
   */
  public int $Center;
  /**
   * The color on the edges of the backdrop in RGB format
   */
  public int $Edges;
  /**
   * The color to be applied to the symbol in RGB format
   */
  public int $Symbol;
  /**
   * The color for the text on the backdrop in RGB format
   */
  public int $Text;

  public function __construct(
    array $Data
  ){
    $this->Center = $Data['center_color'];
    $this->Edges = $Data['edge_color'];
    $this->Symbol = $Data['symbol_color'];
    $this->Text = $Data['text_color'];
  }
}