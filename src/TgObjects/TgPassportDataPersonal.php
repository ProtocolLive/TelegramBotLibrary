<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @version 2023.05.30.00
 */
class TgPassportDataPersonal{
  public string|null $Data;
  public string|null $Hash;
  public string|null $Name = null;
  public string|null $NameMiddle = null;
  public string|null $NameLast = null;
  public string|null $Birthday = null;
  public string|null $Sex = null;
  public string|null $Country = null;
  public string|null $CountryResidence = null;

  public function __construct(array $Data){
    $this->Data = base64_decode($Data['data']);
    $this->Hash = base64_decode($Data['hash']);
  }
}