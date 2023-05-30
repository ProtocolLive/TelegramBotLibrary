<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @version 2023.05.30.00
 */
class TgPassportDataAddress{
  public string|null $Data;
  public string|null $Hash;
  public string|null $Country = null;
  public string|null $PostCode = null;
  public string|null $State = null;
  public string|null $City = null;
  public string|null $Street1 = null;
  public string|null $Street2 = null;

  public function __construct(array $Data){
    $this->Data = base64_decode($Data['data']);
    $this->Hash = base64_decode($Data['hash']);
  }
}