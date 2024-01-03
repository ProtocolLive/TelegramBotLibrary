<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgParams;

/**
 * @version 2024.01.03.00
 */
final class TgInvoiceShippingOptions{
  private array $Options = [];

  public function Add(
    TgInvoiceShippingOption $Option
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