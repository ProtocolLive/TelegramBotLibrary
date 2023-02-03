<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.02.03.00

namespace ProtocolLive\TelegramBotLibrary\TblObjects;

class TblInvoiceShippingOptions{
  private array $Options;

  public function Add(
    TblInvoiceShippingOption $Option
  ):void{
    $this->Options[] = [
      'id' => $Option->Id,
      'title' => $Option->Name,
      'prices' => $Option->Prices->ToArray()
    ];
  }

  public function ToArray():array{
    return $this->Options;
  }
}