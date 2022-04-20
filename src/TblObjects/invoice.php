<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.04.19.00

class TblInvoiceProduct{
  public function __construct(
    public readonly string $Name,
    public readonly int $Price
  ){}
}