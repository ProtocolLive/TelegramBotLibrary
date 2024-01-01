<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgInvoiceCurrencies;

/**
 * @version 2024.01.01.00
 */
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