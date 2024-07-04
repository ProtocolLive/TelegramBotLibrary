<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
* @version 2024.07.04.00
*/
final readonly class TgPollAnswer
implements TgEventInterface{
  public TgMessageData $Data;
  public string $Id;
  public array $Options;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Id = $Data['poll_id'];
    $this->Options = $Data['option_ids'];
  }
}