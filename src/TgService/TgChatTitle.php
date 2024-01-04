<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgService;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgServiceInterface
};
use ProtocolLive\TelegramBotLibrary\TgObjects\TgMessageData;

/**
 * A chat title was changed to this value
 * @link https://core.telegram.org/bots/api#message
 * @version 2024.01.04.00
 */
final readonly class TgChatTitle
implements TgServiceInterface, TgEventInterface{
  public TgMessageData $Data;
  /**
   * A chat title was changed to this value
   */
  public string $Title;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Title = $Data['new_chat_title'];
  }
}