<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.12.30.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * A chat title was changed to this value
 * @link https://core.telegram.org/bots/api#message
 */
final class TgChatTitle{
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