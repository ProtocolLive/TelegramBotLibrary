<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;

/**
 * @link https://core.telegram.org/bots/api#businessopeninghoursinterval
 * @version 2025.04.12.00
 */
final readonly class TgBusinessInterval{
  /**
   * The minute's sequence number in a week, starting on Monday, marking the start of the time interval during which the business is open; 0 - 7 24 60
   */
  public int $Open;
  /**
   * The minute's sequence number in a week, starting on Monday, marking the end of the time interval during which the business is open; 0 - 8 24 60
   */
  public int $Close;

  public function __construct(
    array $Data
  ){
    $this->Open = $Data['opening_minute'];
    $this->Close = $Data['closing_minute'];
  }
}