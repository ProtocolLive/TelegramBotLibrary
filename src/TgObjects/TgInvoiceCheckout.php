<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgInvoiceCurrencies;

/**
 * @version 2024.01.01.00
 */
class TgInvoiceCheckout{
  public readonly string $Id;
  public readonly TgUser $User;
  public readonly TgInvoiceCurrencies $Currency;
  public readonly Int $Amount;
  public readonly string $Payload;
  public readonly TgInvoiceOrderInfo|null $OrderInfo;

  public function __construct(array $Data){
    $this->Id = $Data['id'];
    $this->User = new TgUser($Data['from']);
    $this->Currency = TgInvoiceCurrencies::tryFrom($Data['currency']);
    $this->Amount = $Data['total_amount'];
    $this->Payload = $Data['invoice_payload'];
    if(isset($Data['order_info'])):
      $this->OrderInfo = new TgInvoiceOrderInfo($Data['order_info']);
    else:
      $this->OrderInfo = null;
    endif;
  }
}