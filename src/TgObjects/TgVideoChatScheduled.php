<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#forumtopicclosed
 * @version 2023.05.23.00
 */
final class TgVideoChatScheduled
extends TgObject{
  public readonly TgMessageData $Data;
  public readonly int $Start;

  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    $this->Start = $Data['video_chat_scheduled']['start_date'];
  }
}