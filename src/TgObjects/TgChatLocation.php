<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#chatlocation
 * @link https://core.telegram.org/bots/api#location
 * @version 2024.01.04.01
 */
final readonly class TgChatLocation{
  /**
   * Location address; 1-64 characters, as defined by the chat owner
   */
  public string $Address;
  /**
   * Latitude as defined by sender
   */
  public float $Latitude;
  /**
   * Longitude as defined by sender
   */
  public float $Longitude;

  public function __construct(
    array $Data
  ){
    $this->Address = $Data['address'];
    $this->Latitude = $Data['location']['latitude'];
    $this->Longitude = $Data['location']['longitude'];
  }
}