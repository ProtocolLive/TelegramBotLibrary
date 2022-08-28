<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

class TgInvoice{
  public readonly TgMessage $Message;
  public readonly TgInvoiceData $Data;

  public function __construct(array $Data){
    $this->Message = new TgMessage($Data);
    $this->Data = new TgInvoiceData($Data);
  }
}