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
 * Describes a service message about a change in the price of direct messages sent to a channel chat.
 * @link https://core.telegram.org/bots/api#directmessagepricechanged
 * @version 2025.07.04.00
 */
final readonly class TgDirectMessagePriceChanged
implements TgEventInterface,
TgServiceInterface{
  public TgMessageData $Data;
  /**
   * If direct messages are enabled for the channel chat
   */
  public bool $DirectMessages;
  /**
   * The new number of Telegram Stars that must be paid by users for each direct message sent to the channel. Does not apply to users who have been exempted by administrators. Defaults to 0.
   */
  public int $Price;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->DirectMessages = $Data['direct_message_price_changed']['are_direct_messages_enabled'];
    $this->Price = $Data['direct_message_price_changed']['direct_message_star_count'];
  }
}