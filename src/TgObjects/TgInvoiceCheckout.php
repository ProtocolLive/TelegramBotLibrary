<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgInvoiceCurrencies;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * @version 2024.01.04.00
 */
final readonly class TgInvoiceCheckout
implements TgEventInterface{
  public string $Id;
  public TgUser $User;
  public TgInvoiceCurrencies $Currency;
  public Int $Amount;
  public string $Payload;
  public TgInvoiceOrderInfo|null $OrderInfo;

  public function __construct(
    array $Data
  ){
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