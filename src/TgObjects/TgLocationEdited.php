<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

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