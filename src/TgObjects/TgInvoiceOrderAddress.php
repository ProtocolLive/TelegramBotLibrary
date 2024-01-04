<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * This object represents a shipping address.
 * @link https://core.telegram.org/bots/api#shippingaddress
 * @version 2024.01.04.00
 */
final readonly class TgInvoiceOrderAddress{
  public string $Country;
  public string $State;
  public string $City;
  public string $Street1;
  public string $Street2;
  public string $ZipCode;

  public function __construct(
    array $Data
  ){
    $this->Country = $Data['country_code'];
    $this->State = $Data['state'];
    $this->City = $Data['city'];
    $this->Street1 = $Data['street_line1'];
    $this->Street2 = $Data['street_line2'];
    $this->ZipCode = $Data['post_code'];
  }
}