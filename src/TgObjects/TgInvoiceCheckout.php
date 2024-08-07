<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgCurrencies;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * @version 2024.07.07.00
 */
final readonly class TgInvoiceCheckout
implements TgEventInterface{
  public TgMessageData $Data;
  public TgCurrencies $Currency;
  public Int $Amount;
  public string $Payload;
  public TgInvoiceOrderInfo|null $OrderInfo;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Currency = TgCurrencies::tryFrom($Data['currency']);
    $this->Amount = $Data['total_amount'];
    $this->Payload = $Data['invoice_payload'];
    if(isset($Data['order_info'])):
      $this->OrderInfo = new TgInvoiceOrderInfo($Data['order_info']);
    else:
      $this->OrderInfo = null;
    endif;
  }
}