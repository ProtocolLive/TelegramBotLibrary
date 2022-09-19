<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.09.19.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

class TgPassportDataDriver{
  public string $Data;
  public string $Hash;
  public string|null $Number = null;
  public string|null $Expiry = null;

  public function __construct(array $Data){
    $this->Data = base64_decode($Data['data']);
    $this->Hash = base64_decode($Data['hash']);
  }
}