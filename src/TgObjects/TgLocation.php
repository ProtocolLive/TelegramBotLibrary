<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

class TgLocation{
  public readonly TgMessage $Message;
  public readonly float $Latitude;
  public readonly float $Longitude;
  public readonly int|null $LiveTime;

  public function __construct(array $Data){
    $this->Message = new TgMessage($Data);
    $this->Latitude = $Data['location']['latitude'];
    $this->Longitude = $Data['location']['longitude'];
    $this->LiveTime = $Data['location']['live_period'] ?? null;
  }
}