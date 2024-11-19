<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * Describes an inline message to be sent by a user of a Mini App.
 * @link https://core.telegram.org/bots/api#preparedinlinemessage
 * @version 2024.11.19.00
 */
final readonly class TgPreparedInlineMessage{
  /**
   * Unique identifier of the prepared message
   */
  public string $Id;
  /**
   * Expiration date of the prepared message, in Unix time. Expired prepared messages can no longer be used
   */
  public int $Expiration;

  public function __construct(
    array $Data
  ){
    $this->Id = $Data['id'];
    $this->Expiration = $Data['expiration_date'];
  }
}