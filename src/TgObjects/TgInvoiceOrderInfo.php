<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * This object represents information about an order.
 * @link https://core.telegram.org/bots/api#orderinfo
 * @version 2024.01.04.00
 */
final readonly class TgInvoiceOrderInfo{
  public string|null $Name;
  public string|null $Phone;
  public string|null $Email;
  public TgInvoiceOrderAddress|null $Address;

  public function __construct(
    array $Data
  ){
    if(isset($Data['name'])):
      $this->Name = $Data['name'];
    else:
      $this->Name = null;
    endif;
    if(isset($Data['phone_number'])):
      $this->Phone = $Data['phone_number'];
    else:
      $this->Phone = null;
    endif;
    if(isset($Data['email'])):
      $this->Email = $Data['email'];
    else:
      $this->Email = null;
    endif;
    if(isset($Data['shipping_address'])):
      $this->Address = new TgInvoiceOrderAddress($Data['shipping_address']);
    else:
      $this->Address = null;
    endif;
  }
}