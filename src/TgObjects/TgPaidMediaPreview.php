<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @version 2024.07.05.00
 */
final readonly class TgPaidMediaPreview{
  /**
   * Media width as defined by the sender
   */
  public int|null $Width;
  /**
   * Media height as defined by the sender
   */
  public int|null $Height;
  /**
   * Duration of the media in seconds as defined by the sender
   */
  public int|null $Duration;

  public function __construct(
    array $Data
  ){
    $this->Width = $Data['width'];
    $this->Height = $Data['height'];
    $this->Duration = $Data['duration'];
  }
}