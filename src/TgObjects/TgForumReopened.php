<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#forumtopicreopened
 * @version 2023.05.23.00
 */
final class TgForumReopened
extends TgObject{
  public readonly TgMessageData $Data;

  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
  }
}