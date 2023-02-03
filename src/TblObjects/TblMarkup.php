<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.02.03.00

namespace ProtocolLive\TelegramBotLibrary\TblObjects;

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