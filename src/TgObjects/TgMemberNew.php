<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.05.20.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * New members that were added to the group or supergroup and information about them (the bot itself may be one of these members)
 */
class TgMemberNew{
  public readonly TgMessageData $Data;
  public readonly TgUser $Member;

  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    $this->Member = new TgUser($Data['new_chat_member']);
  }
}