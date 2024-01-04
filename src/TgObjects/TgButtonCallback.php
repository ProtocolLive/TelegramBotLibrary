<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @version 2024.01.04.00
 */
final readonly class TgButtonCallback{
  public string $Text;
  public string $Callback;

  public function __construct(
    array $Data = null
  ){
    $this->Text = $Data['text'];
    $this->Callback = $Data['callback_data'];
  }
}