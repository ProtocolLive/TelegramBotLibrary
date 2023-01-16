<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.01.16.00

namespace ProtocolLive\TelegramBotLibrary\TblObjects;

final class TblInlineQueryResults{
  private array $Results = [];

  public function __construct(
    TblInlineQuery $Result = null
  ){
    if($Result !== null):
      $this->Add($Result);
    endif;
  }

  public function Add(
    TblInlineQuery $Result
  ):void{
    $this->Results[] = $Result->ToArray();
  }

  public function ToJson():string{
    return json_encode($this->Results, JSON_UNESCAPED_SLASHES);
  }
}