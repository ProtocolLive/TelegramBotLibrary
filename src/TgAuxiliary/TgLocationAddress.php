<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;

/**
 * Describes the physical address of a location.
 * @link https://core.telegram.org/bots/api#locationaddress
 * @version 2025.05.11.00
 */
final class TgLocationAddress{
  /**
   * @param string $Country The two-letter ISO 3166-1 alpha-2 country code of the country where the location is located
   * @param string $State State of the location
   * @param string $City City of the location
   * @param string $Street Street address of the location
   */
  public function __construct(
    public string $Country,
    public string|null $State = null,
    public string|null $City = null,
    public string|null $Street = null
  ){}

  public function ToArray():array{
    $param['country'] = $this->Country;
    if($this->State !== null):
      $param['state'] = $this->State;
    endif;
    if($this->City !== null):
      $param['city'] = $this->City;
    endif;
    if($this->Street !== null):
      $param['street'] = $this->Street;
    endif;
    return $param;
  }
}