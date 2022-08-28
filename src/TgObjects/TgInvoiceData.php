<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

class TgInvoiceData{
  public readonly string $Title;
  public readonly string $Description;
  public readonly string $StartParam;
  public readonly TgInvoiceCurrencies $Currency;
  public readonly Int $Amount;

  public function __construct(array $Data){
    $this->Title = $Data['title'];
    $this->Description = $Data['description'];
    $this->StartParam = $Data['start_parameter'];
    $this->Currency = TgInvoiceCurrencies::tryFrom($Data['currency']);
    $this->Amount = $Data['total_amount'];
  }
}