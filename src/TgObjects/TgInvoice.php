<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @version 2023.05.23.00
 */
final class TgInvoice
extends TgObject{
  public readonly TgMessageData $Data;
  public readonly TgInvoiceData $Invoice;

  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    $this->Invoice = new TgInvoiceData($Data);
  }
}