<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgService;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgServiceInterface
};

/**
 * Service message: auto-delete timer settings changed in the chat. New auto-delete time for messages in the chat; in seconds
 * @link https://core.telegram.org/bots/api#message
 * @link https://core.telegram.org/bots/api#messageautodeletetimerchanged
 * @version 2025.06.17.00
 */
final readonly class TgChatAutoDel
implements TgEventInterface,
TgServiceInterface{
  public TgMessageData $Data;
  /**
   * New auto-delete time for messages in the chat; in seconds
   */
  public int $Time;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Time = $Data['message_auto_delete_timer_changed']['message_auto_delete_time'];
  }
}