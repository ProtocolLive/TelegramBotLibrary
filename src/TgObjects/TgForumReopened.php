<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.11.05.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

final class TgForumReopened{
  public readonly TgMessage $Message;

  public function __construct(array $Data){
    $this->Message = new TgMessage($Data);
  }
}