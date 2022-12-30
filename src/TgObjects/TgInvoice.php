<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.12.30.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

class TgInvoice{
  public readonly TgMessageData $Data;
  public readonly TgInvoiceData $Invoice;

  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    $this->Invoice = new TgInvoiceData($Data);
  }
}