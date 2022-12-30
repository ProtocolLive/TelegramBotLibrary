<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.12.30.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#photosize
 */
class TgPinnedMsg{
  public TgMessageData $Data;
  public TgMessageData $Pinned;

  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    $this->Pinned = new TgMessageData($Data['pinned_message']);
  }
}