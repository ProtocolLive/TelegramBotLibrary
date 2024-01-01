<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgForwadableInterface
};

/**
 * @link https://core.telegram.org/bots/api#videonote
 * @version 2024.01.01.00
 */
final class TgVideoNoteEdited
extends TgVideoNote
implements TgForwadableInterface, TgEventInterface{
  public readonly int $DateEdited;

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