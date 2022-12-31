<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.12.31.00

namespace ProtocolLive\TelegramBotLibrary\TblObjects;

abstract class TblServerMulti{
  protected array $Args = [];

  public function GetArray():array{
    return $this->Args;
  }
}