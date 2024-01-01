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
 * New members that were added to the group or supergroup and information about them (the bot itself may be one of these members)
 * @version 2024.01.01.02
 */
final class TgMemberNew
implements TgServiceInterface, TgEventInterface{
  public readonly TgMessageData $Data;
  public readonly TgUser $Member;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Member = new TgUser($Data['new_chat_member']);
  }
}