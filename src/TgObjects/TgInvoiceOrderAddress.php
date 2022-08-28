<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#shippingaddress
 */
class TgInvoiceOrderAddress{
  public readonly string $Country;
  public readonly string $State;
  public readonly string $City;
  public readonly string $Street1;
  public readonly string $Street2;
  public readonly string $ZipCode;
  
  /**
   * @link https://core.telegram.org/bots/api#shippingaddress
   */
  public function __construct(array $Data){
    $this->Country = $Data['country_code'];
    $this->State = $Data['state'];
    $this->City = $Data['city'];
    $this->Street1 = $Data['street_line1'];
    $this->Street2 = $Data['street_line2'];
    $this->ZipCode = $Data['post_code'];
  }
}