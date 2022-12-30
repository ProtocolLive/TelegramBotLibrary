<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.12.30.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

final class TgButtonCallback{
  public readonly string $Text;
  public readonly string $Callback;

  public function __construct(
    array $Data = null
  ){
    $this->Text = $Data['text'];
    $this->Callback = $Data['callback_data'];
  }
}