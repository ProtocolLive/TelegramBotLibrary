<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgForwadableInterface;

/**
 * @link https://core.telegram.org/bots/api#story
 * @version 2023.08.18.00
 */
class TgStory
extends TgObject
implements TgForwadableInterface{
  public readonly TgMessageData $Data;
  
  /**
   * This object represents a message about a forwarded story in the chat. Currently holds no information.
   * @link https://core.telegram.org/bots/api#story
   */
  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
  }
}