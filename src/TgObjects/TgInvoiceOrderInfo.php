<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.09.21.01

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#orderinfo
 */
class TgInvoiceOrderInfo{
  public readonly string|null $Name;
  public readonly string|null $Phone;
  public readonly string|null $Email;
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