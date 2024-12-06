<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;

/**
 * @version 2023.02.03.00
 */
abstract class TblMarkup{
  protected array $Markup;
  protected array $Pointer;

  public function ButtonGet(
    int $Line,
    int $Col
  ):array{
    return $this->Pointer[$Line][$Col];
  }

  public function ToArray():array{
    return $this->Markup;
  }
}