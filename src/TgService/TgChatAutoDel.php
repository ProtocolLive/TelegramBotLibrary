<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgService;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgServiceInterface;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgMessageData;

/**
 * Service message: auto-delete timer settings changed in the chat. New auto-delete time for messages in the chat; in seconds
 * @link https://core.telegram.org/bots/api#message
 * @link https://core.telegram.org/bots/api#messageautodeletetimerchanged
 * @version 2024.01.01.01
 */
final class TgChatAutoDel
implements TgServiceInterface{
  public readonly TgMessageData $Data;
  /**
   * New auto-delete time for messages in the chat; in seconds
   */
  public readonly int $Time;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Time = $Data['message_auto_delete_timer_changed']['message_auto_delete_time'];
  }
}