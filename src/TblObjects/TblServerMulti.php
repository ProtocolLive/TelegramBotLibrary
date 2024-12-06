<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;

/**
 * @version 2023.01.15.00
 */
abstract class TblServerMulti{
  protected array $Args = [];

  /**
   * @return array[]
   */
  public function GetArray():array{
    return $this->Args;
  }
}