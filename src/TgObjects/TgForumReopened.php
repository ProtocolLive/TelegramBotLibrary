<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.12.30.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#forumtopicreopened
 */
final class TgForumReopened{
  public readonly TgMessageData $Data;

  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
  }
}