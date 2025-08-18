<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;

use ProtocolLive\TelegramBotLibrary\TgEnums\TgCurrencies;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgSuggestedPostInfoState;

/**
 * Contains information about a suggested post.
 * @link https://core.telegram.org/bots/api#suggestedpostinfo
 * @link https://core.telegram.org/bots/api#suggestedpostprice
 * @version 2025.08.17.00
 */
final readonly class TgSuggestedPostInfo{
  /**
   * State of the suggested post. Currently, it can be one of “pending”, “approved”, “declined”.
   */
  public TgSuggestedPostInfoState $State;
  /**
   * Currency in which the post will be paid. Currently, must be one of “XTR” for Telegram Stars or “TON” for toncoins
   */
  public TgCurrencies $Currency;
  /**
   * The amount of the currency that will be paid for the post in the smallest units of the currency, i.e. Telegram Stars or nanotoncoins. Currently, price in Telegram Stars must be between 5 and 100000, and price in nanotoncoins must be between 10000000 and 10000000000000.
   */
  public int $Amount;
  /**
   * Proposed send date of the post. If the field is omitted, then the post can be published at any time within 30 days at the sole discretion of the user or administrator who approves it.
   */
  public int|null $SendDate;

  public function __construct(
    array $Data
  ){
    $this->State = TgSuggestedPostInfoState::from($Data['state']);
    $this->Currency = TgCurrencies::from($Data['currency']);
    $this->Amount = $Data['amount'];
    $this->SendDate = $Data['send_date'] ?? null;
  }
}