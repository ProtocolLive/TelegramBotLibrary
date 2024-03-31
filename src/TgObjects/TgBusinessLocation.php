<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @version 2024.03.31.00
 * @link https://core.telegram.org/bots/api#businesslocation
 */
final readonly class TgBusinessLocation{
  /**
   * Address of the business
   */
  public string $Address;
  /**
   * Location of the business
   */
  public TgLocation $Location;

  public function __construct(
    array $Data
  ){
    $this->Address = $Data['address'];
    if($Data['location'] === null):
      $this->Location = null;
    else:
      $this->Location = new TgLocation($Data['location']);
    endif;
  }
}