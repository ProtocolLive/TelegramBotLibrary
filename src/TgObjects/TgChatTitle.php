<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

class TgChatTitle{
  public readonly TgMessage $Message;
  public readonly string $Title;

  /**
   * A chat title was changed to this value
   * @link https://core.telegram.org/bots/api#message
   */
  public function __construct(array $Data){
    $this->Message = new TgMessage($Data);
    $this->Title = $Data['new_chat_title'];
  }
}