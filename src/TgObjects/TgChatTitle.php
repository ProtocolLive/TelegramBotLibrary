<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * A chat title was changed to this value
 * @link https://core.telegram.org/bots/api#message
 * @version 2023.05.23.00
 */
final class TgChatTitle
extends TgObject{
  public readonly TgMessageData $Data;
  /**
   * A chat title was changed to this value
   */
  public readonly string $Title;

  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    $this->Title = $Data['new_chat_title'];
  }
}