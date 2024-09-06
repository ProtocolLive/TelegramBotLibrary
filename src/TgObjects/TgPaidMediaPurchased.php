<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;

/**
 * @version 2024.09.06.00
 * @link https://core.telegram.org/bots/api#paidmediapurchased
 */
final readonly class TgPaidMediaPurchased{
  public TgMessageData $Data;
  /**
   * Bot-specified paid media payload
   */
  public string $Payload;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Payload = $Data['paid_media_payload'];
  }
}