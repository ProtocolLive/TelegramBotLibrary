<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEditedInterface;

/**
 * This object represents a edited voice note.
 * @link https://core.telegram.org/bots/api#voice
 * @version 2024.02.08.00
 */
final readonly class TgVoiceEdited
extends TgVoice
implements TgEditedInterface{
  public TgMessageData $Data;
  public int $DateEdited;

  public function __construct(
    array $Data
  ){
    parent::__construct($Data);
    $this->DateEdited = $Data['edit_date'];
  }
}