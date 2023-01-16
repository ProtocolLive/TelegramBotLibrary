<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.01.16.00

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

  /**
   * Get the markup object in json format
   */
  public function ToJson():string{
    return json_encode($this->Markup, JSON_UNESCAPED_SLASHES);
  }

  public function ToArray():array{
    return $this->Markup;
  }
}