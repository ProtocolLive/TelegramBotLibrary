<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.09.21.01

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

class TgInvoiceCheckout{
  public readonly string $Id;
  public readonly TgUser $User;
  public readonly TgInvoiceCurrencies $Currency;
  public readonly Int $Amount;
  public readonly string $Payload;
  public readonly TgInvoiceOrderInfo $OrderInfo;

  public function __construct(array $Data){
    $this->Id = $Data['id'];
    $this->User = new TgUser($Data['from']);
    $this->Currency = TgInvoiceCurrencies::tryFrom($Data['currency']);
    $this->Amount = $Data['total_amount'];
    $this->Payload = $Data['invoice_payload'];
    $this->OrderInfo = new TgInvoiceOrderInfo($Data['order_info']);
  }
}