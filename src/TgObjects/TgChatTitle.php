<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.12.08.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * A chat title was changed to this value
 * @link https://core.telegram.org/bots/api#message
 */
final class TgChatTitle{
  public readonly TgMessage $Message;
  /**
   * A chat title was changed to this value
   */
  public readonly string $Title;

  public function __construct(array $Data){
    $this->Message = new TgMessage($Data);
    $this->Title = $Data['new_chat_title'];
  }
}