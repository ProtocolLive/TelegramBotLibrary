<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.12.30.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

class TgMemberNew{
  public readonly TgMessageData $Data;
  public readonly TgUser $Member;

  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    $this->Member = new TgUser($Data['new_chat_member']);
  }
}