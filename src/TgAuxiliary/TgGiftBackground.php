<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;

/**
 * This object describes the background of a gift.
 * @link https://core.telegram.org/bots/api#giftbackground
 * @version 2026.02.09.00
 */
final readonly class TgGiftBackground{
  /**
   * Center color of the background in RGB format
   */
  public int $Center;
  /**
   * Edge color of the background in RGB format
   */
  public int $Edge;
  /**
   * Text color of the background in RGB format
   */
  public int $Text;
  
  public function __construct(
    array $Data
  ){
    $this->Center = $Data['center_color'];
    $this->Edge = $Data['edge_color'];
    $this->Text = $Data['text_color'];
  }
}