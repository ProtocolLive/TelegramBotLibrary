<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.09.19.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

class TgPassportDataPersonal{
  public string $Data;
  public string $Hash;
  public string|null $Name = null;
  public string|null $NameMiddle = null;
  public string|null $NameLast = null;
  public string|null $Birthday = null;
  public string|null $Gender = null;
  public string|null $Country = null;
  public string|null $CountryResidence = null;

  public function __construct(array $Data){
    $this->Data = base64_decode($Data['data']);
    $this->Hash = base64_decode($Data['hash']);
  }
}