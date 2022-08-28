<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.19.00

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

  public function ToJson():string{
    return json_encode($this->Options);
  }
}