<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#webappdata
 * @version 2025.05.23.00
 */
final class TgWebappData
extends TgObject{
  /**
   * Text of the web_app keyboard button from which the Web App was opened. Be aware that a bad client can send arbitrary data in this field.
   */
  public readonly string $Text;
  /**
   * The data. Be aware that a bad client can send arbitrary data in this field.
   */
  public readonly string $Data;

  public function __construct(array $Data){
    $this->Text = $Data['web_app_data']['button_text'];
    $this->Data = $Data['web_app_data']['data'];
  }
}