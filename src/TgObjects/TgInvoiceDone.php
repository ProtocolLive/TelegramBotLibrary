<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgInvoiceCurrencies;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * This object contains basic information about a successful payment.
 * @link https://core.telegram.org/bots/api#successfulpayment
 * @version 2024.01.01.00
 */
final readonly class TgInvoiceDone
implements TgEventInterface{
  public  TgMessageData $Data;
  public TgInvoiceCurrencies $Currency;
  public Int $Amount;
  public string $Payload;
  public TgInvoiceOrderInfo $OrderInfo;
  public string $PayTelegramId;
  public string $PayProviderId;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Currency = TgInvoiceCurrencies::tryFrom($Data['successful_payment']['currency']);
    $this->Amount = $Data['successful_payment']['total_amount'];
    $this->Payload = $Data['successful_payment']['invoice_payload'];
    $this->OrderInfo = new TgInvoiceOrderInfo($Data['successful_payment']['order_info']);
    $this->PayTelegramId = $Data['successful_payment']['telegram_payment_charge_id'];
    $this->PayProviderId = $Data['successful_payment']['provider_payment_charge_id'];
  }
}