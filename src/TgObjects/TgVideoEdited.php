<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#message
 * @version 2024.02.08.00
 */
final readonly class TgVideoEdited
extends TgVideo{
  public  int $DateEdited;

  /**
   * New version of a message that is known to the bot and was edited
   * @link https://core.telegram.org/bots/api#message
   */
  public function __construct(
    array $Data
  ){
    parent::__construct($Data);
    $this->DateEdited = $Data['edit_date'];
  }
}