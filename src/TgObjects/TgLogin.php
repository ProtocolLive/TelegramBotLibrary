<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * @link https://core.telegram.org/bots/api#message
 * @version 2024.01.04.00
 */
final readonly class TgLogin
implements TgEventInterface{
  public TgMessageData $Data;
  /**
   * The domain name of the website on which the user has logged in. More about in Telegram Login.
   */
  public string $Site;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Site = $Data['connected_website'];
  }
}