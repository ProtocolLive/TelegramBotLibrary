<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.12.30.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

final class TgButtonWebapp{
  public readonly string $Text;
  public readonly string $Url;

  public function __construct(
    array $Data = null
  ){
    $this->Text = $Data['text'];
    $this->Url = $Data['web_app']['url'];
  }
}