<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.05.30.00

class TgWebappData{
  public readonly string $Text;
  public readonly string $Data;

  public function __construct(array $Data){
    $this->Text = $Data['web_app_data']['button_text'];
    $this->Data = $Data['web_app_data']['data'];
  }
}