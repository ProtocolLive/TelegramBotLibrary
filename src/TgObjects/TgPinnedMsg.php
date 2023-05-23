<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#photosize
 * @version 2023.05.23.00
 */
final class TgPinnedMsg
extends TgObject{
  public TgMessageData $Data;
  public TgMessageData $Pinned;

  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    $this->Pinned = new TgMessageData($Data['pinned_message']);
  }
}