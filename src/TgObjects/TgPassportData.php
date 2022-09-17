<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.09.17.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

class TgPassportData{
  public readonly TgPassportDataType $Type;
  public readonly string $Data;
  public readonly string $Hash;

  public function __construct(array $Data){
    $this->Type = TgPassportDataType::from($Data['type']);
    if($this->Type === TgPassportDataType::Email):
      $this->Data = $Data['email'];
    elseif($this->Type === TgPassportDataType::Phone):
      $this->Data = $Data['phone_number'];
    else:
      $this->Data = $Data['data'];
    endif;
    $this->Hash = $Data['hash'];
  }
}