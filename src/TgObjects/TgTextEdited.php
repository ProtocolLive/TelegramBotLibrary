<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#message
 */
class TgTextEdited extends TgText{
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