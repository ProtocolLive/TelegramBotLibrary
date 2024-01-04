<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * @link https://core.telegram.org/bots/api#webappdata
 * @version 2024.01.04.00
 */
final readonly class TgWebappData
implements TgEventInterface{
  /**
   * Text of the web_app keyboard button from which the Web App was opened. Be aware that a bad client can send arbitrary data in this field.
   */
  public string $Text;
  /**
   * The data. Be aware that a bad client can send arbitrary data in this field.
   */
  public string $Data;

  public function __construct(array $Data){
    $this->Text = $Data['web_app_data']['button_text'];
    $this->Data = $Data['web_app_data']['data'];
  }
}