<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgService;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgServiceInterface
};

/**
 * Service message: the price for paid messages has changed in the chat
 * @link https://core.telegram.org/bots/api#paidmessagepricechanged
 * @version 2025.06.03.00
 */
final readonly class TgMessagePriceChange
implements TgEventInterface,
TgServiceInterface{
  public TgMessageData $Data;
  /**
   * The new number of Telegram Stars that must be paid by non-administrator users of the supergroup chat for each sent message
   */
  public int $Stars;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Stars = $Data['paid_message_star_count'];
  }
}