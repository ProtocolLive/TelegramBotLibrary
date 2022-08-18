<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#orderinfo
 */
class TgInvoiceOrderInfo{
  public readonly string $Name;
  public readonly string $Phone;
  public readonly string $Email;
  public readonly TgInvoiceOrderAddress $Address;

  /**
   * @link https://core.telegram.org/bots/api#orderinfo
   */
  public function __construct(array $Data){
    $this->Name = $Data['name'];
    $this->Phone = $Data['phone_number'];
    $this->Email = $Data['email'];
    $this->Address = new TgInvoiceOrderAddress($Data['shipping_address']);
  }
}