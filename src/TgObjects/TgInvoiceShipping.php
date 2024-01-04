<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#shippingquery
 * @version 2024.01.04.00
 */
final readonly class TgInvoiceShipping{
  public string $Id;
  public TgUser $User;
  public string $Payload;
  public TgInvoiceOrderAddress $Address;

  public function __construct(
    array $Data
  ){
    $this->Id = $Data['id'];
    $this->User = new TgUser($Data['from']);
    $this->Payload = $Data['invoice_payload'];
    $this->Address = new TgInvoiceOrderAddress($Data['shipping_address']);
  }
}