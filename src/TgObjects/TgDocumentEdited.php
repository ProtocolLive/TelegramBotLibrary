<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * New version of a message that is known to the bot and was edited
 * @link https://core.telegram.org/bots/api#message
 * @version 2024.02.08.00
 */
final readonly class TgDocumentEdited
extends TgDocument{
  /**
   * Date the message was last edited in Unix time
   */
  public int $DateEdited;

  public function __construct(
    array $Data
  ){
    parent::__construct($Data);
    $this->DateEdited = $Data['edit_date'];
  }
}