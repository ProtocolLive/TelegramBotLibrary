<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

class TgMemberNew{
  public readonly TgMessage $Message;
  public readonly TgUser $Member;

  public function __construct(array $Data){
    $this->Message = new TgMessage($Data);
    $this->Member = new TgUser($Data['new_chat_member']);
  }
}