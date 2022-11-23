<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.11.23.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#photosize
 */
class TgPinnedMsg{
  public TgMessage $Message;
  public TgMessage $Pinned;

  public function __construct(array $Data){
    $this->Message = new TgMessage($Data);
    $this->Pinned = new TgMessage($Data['pinned_message']);
  }
}