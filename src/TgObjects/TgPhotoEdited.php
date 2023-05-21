<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.05.20.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * A chat photo was change to this value
 * @link https://core.telegram.org/bots/api#message
 */
class TgPhotoEdited extends TgPhoto{
  public readonly int $DateEdited;

  /**
   * New version of a message that is known to the bot and was edited
   * @link https://core.telegram.org/bots/api#message
   */
  public function __construct(array $Data){
    parent::__construct($Data);
    $this->DateEdited = $Data['edit_date'];
  }
}