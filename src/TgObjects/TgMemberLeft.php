<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * Represents a chat member that isn't currently a member of the chat, but may join it themselves.
 * https://core.telegram.org/bots/api#chatmemberleft
 */
class TgMemberLeft{
  public readonly TgMessage $Message;
  public readonly TgUser $Member;

  public function __construct(array $Data){
    $this->Message = new TgMessage($Data);
    $this->Member = new TgUser($Data['left_chat_member']);
  }
}