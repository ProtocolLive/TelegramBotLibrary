<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.05.05.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#chatlocation
 * @link https://core.telegram.org/bots/api#location
 */
final class TgChatLocation{
  /**
   * Location address; 1-64 characters, as defined by the chat owner
   */
  public readonly string $Address;
  /**
   * Latitude as defined by sender
   */
  public readonly float $Latitude;
  /**
   * Longitude as defined by sender
   */
  public readonly float $Longitude;

  public function __construct(array $Data){
    $this->Address = $Data['address'];
    $this->Latitude = $Data['location']['latitude'];
    $this->Longitude = $Data['location']['longitude'];
  }
}