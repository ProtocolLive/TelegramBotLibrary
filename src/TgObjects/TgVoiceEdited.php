<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgForwadableInterface
};

/**
 * This object represents a edited voice note.
 * @link https://core.telegram.org/bots/api#voice
 * @version 2024.01.15.00
 */
final readonly class TgVoiceEdited
extends TgVoice
implements TgEventInterface, TgForwadableInterface{
  public TgMessageData $Data;
  public int $DateEdited;

  public function __construct(
    array $Data
  ){
    parent::__construct($Data);
    $this->DateEdited = $Data['edit_date'];
  }
}