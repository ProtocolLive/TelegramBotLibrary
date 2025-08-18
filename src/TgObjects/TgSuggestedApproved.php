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
 * @link https://core.telegram.org/bots/api#suggestedpostapproved
 * @link https://core.telegram.org/bots/api#suggestedpostprice
 * @version 2025.08.18.00
 */
final readonly class TgSuggestedApproved
implements TgEventInterface,
TgServiceInterface{
  public TgMessageData $Data;
  /**
   * Message containing the suggested post. Note that the Message object in this field will not contain the reply_to_message field even if it itself is a reply.
   */
  public TgMessageInterface|null $Message;
  /**
   * Currency in which the post will be paid. Currently, must be one of “XTR” for Telegram Stars or “TON” for toncoins
   */
  public TgCurrencies|null $Currency;
  /**
   * The amount of the currency that will be paid for the post in the smallest units of the currency, i.e. Telegram Stars or nanotoncoins. Currently, price in Telegram Stars must be between 5 and 100000, and price in nanotoncoins must be between 10000000 and 10000000000000.
   */
  public int|null $Amount;
  /**
   * Date when the post will be published
   */
  public int $Date;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    if(isset($Data['message'])):
      $this->Message = TblBasics::DetectMessage($Data['message']);
    else:
      $this->Message = null;
    endif;
    if(isset($Data['price'])):
      $this->Currency = TgCurrencies::from($Data['price']['currency']);
      $this->Amount = $Data['price']['amount'];
    else:
      $this->Currency = null;
      $this->Amount = null;
    endif;
    $this->Date = $Data['date'];
  }
}