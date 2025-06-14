<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgService;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgServiceInterface;

/**
 * Describes a service message about a change in the price of paid messages within a chat.
 * @link https://core.telegram.org/bots/api#paidmessagepricechanged
 * @version 2025.06.14.00
 */
final readonly class TgPaidMessagePriceChanged
implements TgServiceInterface{
  public TgMessageData $Data;
  /**
   * The new number of Telegram Stars that must be paid by non-administrator users of the supergroup chat for each sent message
   */
  public int $Price;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Price = $Data['paid_message_price_changed']['paid_message_star_count'];
  }
}