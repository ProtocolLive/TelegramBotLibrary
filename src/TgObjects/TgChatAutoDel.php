<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#message
 */
class TgChatAutoDel{
  public readonly TgMessage $Message;
  public readonly int $Time;

  /**
   * Service message: auto-delete timer settings changed in the chat. New auto-delete time for messages in the chat; in seconds
   * @link https://core.telegram.org/bots/api#message
   * @link https://core.telegram.org/bots/api#messageautodeletetimerchanged
   */
  public function __construct(array $Data){
    $this->Message = new TgMessage($Data);
    $this->Time = $Data['message_auto_delete_timer_changed']['message_auto_delete_time'];
  }
}