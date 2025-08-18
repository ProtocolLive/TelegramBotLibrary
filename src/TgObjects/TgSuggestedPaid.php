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
 * Describes a service message about a successful payment for a suggested post.
 * @link https://core.telegram.org/bots/api#suggestedpostpaid
 * @link https://core.telegram.org/bots/api#staramount
 * @version 2025.08.18.00
 */
final readonly class TgSuggestedPaid
implements TgEventInterface,
TgServiceInterface{
  public TgMessageData $Data;
  /**
   * Message containing the suggested post. Note that the Message object in this field will not contain the reply_to_message field even if it itself is a reply.
   */
  public TgMessageInterface|null $Message;
  /**
   * Currency in which the payment was made. Currently, one of “XTR” for Telegram Stars or “TON” for toncoins
   */
  public TgCurrencies $Currency;
  /**
   * The amount of the currency that was received by the channel in nanotoncoins; for payments in toncoins only;
   * The amount of Telegram Stars that was received by the channel; for payments in Telegram Stars only.
   * Integer amount of Telegram Stars, rounded to 0; can be negative
   */
  public int $Amount;
  /**
   * The number of 1/1000000000 shares of Telegram Stars; from -999999999 to 999999999; can be negative if and only if amount is non-positive
   */
  public int|null $StarsNano;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    if(isset($Data['message'])):
      $this->Message = TblBasics::DetectMessage($Data['message']);
    else:
      $this->Message = null;
    endif;
    $this->Currency = TgCurrencies::from($Data['currency']);
    if($this->Currency === TgCurrencies::XTR):
      $this->Amount = $Data['star_amount']['ammount'];
      $this->StarsNano = $Data['star_amount']['nanostar_amount'];
    else:
      $this->Amount = $Data['ammount'];
      $this->StarsNano = null;
    endif;
  }
}