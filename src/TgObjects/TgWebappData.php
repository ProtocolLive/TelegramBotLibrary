<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

class TgWebappData{
  public readonly string $Text;
  public readonly string $Data;

  public function __construct(array $Data){
    $this->Text = $Data['web_app_data']['button_text'];
    $this->Data = $Data['web_app_data']['data'];
  }
}