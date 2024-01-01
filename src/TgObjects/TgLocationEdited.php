<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgForwadableInterface
};

/**
 * @version 2024.01.01.00
 */
class TgLocationEdited
extends TgLocation
implements TgForwadableInterface, TgEventInterface{
  public readonly int|null $Heading;
  public readonly int $Accuracy;
  public readonly int $DateEdited;

  public function __construct(
    array $Data
  ){
    parent::__construct($Data);
    $this->Heading = $Data['location']['heading'] ?? null;
    $this->Accuracy = $Data['location']['horizontal_accuracy'];
    $this->DateEdited = $Data['edit_date'];
  }
}