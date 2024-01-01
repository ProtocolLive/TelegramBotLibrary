<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgService;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgServiceInterface
};
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgMessageData,
  TgUser
};

/**
 * Represents a chat member that isn't currently a member of the chat, but may join it themselves.
 * @link https://core.telegram.org/bots/api#chatmemberleft
 * @version 2024.01.01.02
 */
final class TgMemberLeft
implements TgServiceInterface, TgEventInterface{
  public readonly TgMessageData $Data;
  public readonly TgUser $Member;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Member = new TgUser($Data['left_chat_member']);
  }
}