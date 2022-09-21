<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.09.21.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

class TgInvoiceCheckout{
  public readonly string $Id;
  public readonly TgUser $User;
  public readonly TgInvoiceCurrencies $Currency;
  public readonly Int $Amount;
  public readonly string $Payload;
  public readonly string|null $Phone;
  public readonly string|null $Email;

  public function __construct(array $Data){
    $this->Id = $Data['id'];
    $this->User = new TgUser($Data['from']);
    $this->Currency = TgInvoiceCurrencies::tryFrom($Data['currency']);
    $this->Amount = $Data['total_amount'];
    $this->Payload = $Data['invoice_payload'];
    if(isset($Data['order_info']['phone_number'])):
      $this->Phone = $Data['order_info']['phone_number'];
    else:
      $this->Phone = null;
    endif;
    if(isset($Data['order_info']['email'])):
      $this->Email = $Data['order_info']['email'];
    else:
      $this->Email = null;
    endif;
  }
}