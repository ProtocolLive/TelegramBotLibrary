<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgForwadableInterface
};

/**
 * @link https://core.telegram.org/bots/api#story
 * @version 2024.01.04.00
 */
final readonly class TgStory
implements TgEventInterface, TgForwadableInterface{
  public TgMessageData $Data;
  
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