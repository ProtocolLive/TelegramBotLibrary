<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * This object contains information about a poll.
 * @link https://core.telegram.org/bots/api#message
 * @version 2023.07.05.00
 */
final class TgLogin
extends TgObject{
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