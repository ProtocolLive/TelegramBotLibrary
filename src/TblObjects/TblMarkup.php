<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.19.00

namespace ProtocolLive\TelegramBotLibrary\TblObjects;

abstract class TblMarkup{
  protected array $Markup;
  protected array $Pointer;

  /**
   * Get the markup object in json format
   */
  public function ToJson():string{
    return json_encode($this->Markup);
  }

  public function ButtonGet(
    int $Line,
    int $Col
  ):array{
    return $this->Pointer[$Line][$Col];
  }
}