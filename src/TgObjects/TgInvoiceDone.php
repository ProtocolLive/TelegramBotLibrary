<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.12.30.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#successfulpayment
 */
class TgInvoiceDone{
  public readonly TgMessageData $Data;
  public readonly TgInvoiceCurrencies $Currency;
  public readonly Int $Amount;
  public readonly string $Payload;
  public readonly TgInvoiceOrderInfo $OrderInfo;
  public readonly string $PayTelegramId;
  public readonly string $PayProviderId;

  /**
   * @link https://core.telegram.org/bots/api#successfulpayment
   */
  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    $this->Currency = TgInvoiceCurrencies::tryFrom($Data['successful_payment']['currency']);
    $this->Amount = $Data['successful_payment']['total_amount'];
    $this->Payload = $Data['successful_payment']['invoice_payload'];
    $this->OrderInfo = new TgInvoiceOrderInfo($Data['successful_payment']['order_info']);
    $this->PayTelegramId = $Data['successful_payment']['telegram_payment_charge_id'];
    $this->PayProviderId = $Data['successful_payment']['provider_payment_charge_id'];
  }
}