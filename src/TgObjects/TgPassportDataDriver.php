<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @version 2023.05.30.01
 */
class TgPassportDataDriver{
  public string|null $Data;
  public string|null $Hash;
  public string|null $Number = null;
  public string|null $Expiry = null;
  public TgPassportFile|null $Front = null;
  public TgPassportFile|null $Back = null;

  public function __construct(array $Data){
    $this->Data = base64_decode($Data['data']);
    $this->Hash = base64_decode($Data['hash']);
    $this->Front = new TgPassportFile($Data['front_side']);
    $this->Back = new TgPassportFile($Data['reverse_side']);
  }
}