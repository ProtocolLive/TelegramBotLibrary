<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgParams;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgInlineQueryInterface;

/**
 * @version 2024.11.23.00
 */
final class TgInlineQueryResults{
  private array $Results = [];

  public function __construct(
    TgInlineQueryInterface|null $Result = null
  ){
    if($Result !== null):
      $this->Add($Result);
    endif;
  }

  public function Add(
    TgInlineQueryInterface $Result
  ):void{
    $this->Results[] = $Result->ToArray();
  }

  public function ToArray():array{
    return $this->Results;
  }
}