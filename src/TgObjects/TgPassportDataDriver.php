<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @version 2023.05.30.00
 */
class TgPassportDataDriver{
  public string|null $Data;
  public string|null $Hash;
  public string|null $Number = null;
  public string|null $Expiry = null;

  public function __construct(array $Data){
    $this->Data = base64_decode($Data['data']);
    $this->Hash = base64_decode($Data['hash']);
  }
}