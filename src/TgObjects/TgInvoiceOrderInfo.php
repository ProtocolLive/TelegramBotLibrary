<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.09.21.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#orderinfo
 */
class TgInvoiceOrderInfo{
  public readonly string|null $Name;
  public readonly string $Phone;
  public readonly string $Email;
  public readonly TgInvoiceOrderAddress|null $Address;

  /**
   * @link https://core.telegram.org/bots/api#orderinfo
   */
  public function __construct(array $Data){
    if(isset($Data['name'])):
      $this->Name = $Data['name'];
    else:
      $this->Name = null;
    endif;
    $this->Phone = $Data['phone_number'];
    $this->Email = $Data['email'];
    if(isset($Data['shipping_address'])):
      $this->Address = new TgInvoiceOrderAddress($Data['shipping_address']);
    else:
      $this->Address = null;
    endif;
  }
}