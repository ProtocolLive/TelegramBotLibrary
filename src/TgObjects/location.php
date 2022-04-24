<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.04.24.01

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

class TgLocationEdited extends TgLocation{
  public readonly int|null $Heading;
  public readonly int $Accuracy;
  public readonly int $DateEdited;

  public function __construct(array $Data){
    parent::__construct($Data);
    $this->Heading = $Data['location']['heading'] ?? null;
    $this->Accuracy = $Data['location']['horizontal_accuracy'];
    $this->DateEdited = $Data['edit_date'];
  }
}