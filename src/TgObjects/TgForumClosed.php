<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * @link https://core.telegram.org/bots/api#forumtopicclosed
 * @version 2024.01.01.00
 */
final class TgForumClosed
implements TgEventInterface{
  public readonly TgMessageData $Data;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
  }
}