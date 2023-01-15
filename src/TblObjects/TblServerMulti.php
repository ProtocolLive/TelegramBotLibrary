<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.01.15.00

namespace ProtocolLive\TelegramBotLibrary\TblObjects;

abstract class TblServerMulti{
  protected array $Args = [];

  /**
   * @return array[]
   */
  public function GetArray():array{
    return $this->Args;
  }
}