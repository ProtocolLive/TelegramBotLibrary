<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgInvoiceCurrencies;

/**
 * @link https://core.telegram.org/bots/api#invoice
 * @version 2024.01.02.00
 */
final readonly class TgInvoiceData{
  public string $Title;
  public string $Description;
  public string $StartParam;
  public TgInvoiceCurrencies $Currency;
  public int $Amount;

  public function __construct(array $Data){
    $this->Title = $Data['title'];
    $this->Description = $Data['description'];
    $this->StartParam = $Data['start_parameter'];
    $this->Currency = TgInvoiceCurrencies::from($Data['currency']);
    $this->Amount = $Data['total_amount'];
  }
}