<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgService;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblBasics;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgMessageInterface,
  TgServiceInterface
};

/**
 * @link https://core.telegram.org/bots/api#photosize
 * @version 2025.06.17.00
 */
final readonly class TgPinnedMsg
implements TgEventInterface,
TgServiceInterface{
  public TgMessageData $Data;
  public TgMessageInterface $Pinned;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Pinned = TblBasics::DetectMessage($Data['pinned_message']);
  }
}