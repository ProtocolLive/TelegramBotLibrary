<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.12.30.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * Represents a chat member that isn't currently a member of the chat, but may join it themselves.
 * https://core.telegram.org/bots/api#chatmemberleft
 */
class TgMemberLeft{
  public readonly TgMessageData $Data;
  public readonly TgUser $Member;

  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    $this->Member = new TgUser($Data['left_chat_member']);
  }
}