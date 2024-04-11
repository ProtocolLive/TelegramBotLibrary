<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgForwadableInterface
};

/**
 * @version 2024.04.11.00
 */
final readonly class TgInvoice
implements TgEventInterface, TgForwadableInterface{
  public TgMessageData $Data;
  public TgInvoiceData $Invoice;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Invoice = new TgInvoiceData($Data['invoice']);
  }
}