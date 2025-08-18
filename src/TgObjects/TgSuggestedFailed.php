<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblBasics;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgCurrencies;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgMessageInterface,
  TgServiceInterface
};

/**
 * Describes a service message about the failed approval of a suggested post. Currently, only caused by insufficient user funds at the time of approval.
 * @link https://core.telegram.org/bots/api#suggestedpostapprovalfailed
 * @link https://core.telegram.org/bots/api#suggestedpostprice
 * @version 2025.08.18.00
 */
final readonly class TgSuggestedFailed
implements TgEventInterface,
TgServiceInterface{
  public TgMessageData $Data;
  /**
   * Message containing the suggested post whose approval has failed. Note that the Message object in this field will not contain the reply_to_message field even if it itself is a reply.
   */
  public TgMessageInterface|null $Message;
  /**
   * Currency in which the post will be paid. Currently, must be one of “XTR” for Telegram Stars or “TON” for toncoins
   */
  public TgCurrencies $Currency;
  /**
   * The amount of the currency that will be paid for the post in the smallest units of the currency, i.e. Telegram Stars or nanotoncoins. Currently, price in Telegram Stars must be between 5 and 100000, and price in nanotoncoins must be between 10000000 and 10000000000000.
   */
  public int|null $Amount;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    if(isset($Data['message'])):
      $this->Message = TblBasics::DetectMessage($Data['message']);
    else:
      $this->Message = null;
    endif;
    $this->Currency = TgCurrencies::from($Data['price']['currency']);
    $this->Amount = $Data['price']['amount'];
  }
}