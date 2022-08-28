<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#shippingquery
 */
class TgInvoiceShipping{
  public readonly string $Id;
  public readonly TgUser $User;
  public readonly string $Payload;
  public readonly TgInvoiceOrderAddress $Address;

  public function __construct(array $Data){
    $this->Id = $Data['id'];
    $this->User = new TgUser($Data['from']);
    $this->Payload = $Data['invoice_payload'];
    $this->Address = new TgInvoiceOrderAddress($Data['shipping_address']);
  }
}