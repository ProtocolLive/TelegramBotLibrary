<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * This object represents a residential address.
 * @link https://core.telegram.org/passport#residentialaddress
 * @version 2024.01.04.01
 */
class TgPassportDataAddress{
  public string|null $Data;
  public string|null $Hash;
  /**
   * ISO 3166-1 alpha-2 country code
   */
  public string|null $Country = null;
  /**
   * 	Address post code
   */
  public string|null $PostCode = null;
  /**
   * State
   */
  public string|null $State = null;
  /**
   * City
   */
  public string|null $City = null;
  /**
   * First line for the address
   */
  public string|null $Street1 = null;
  /**
   * Second line for the address
   */
  public string|null $Street2 = null;

  public function __construct(
    array $Data
  ){
    $this->Data = base64_decode($Data['data']);
    $this->Hash = base64_decode($Data['hash']);
  }
}