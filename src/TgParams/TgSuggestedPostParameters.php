<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgParams;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgCurrencies;

/**
 * Contains parameters of a post that is being suggested by the bot.
 * @link https://core.telegram.org/bots/api#suggestedpostparameters
 * @link https://core.telegram.org/bots/api#suggestedpostprice
 * @version 2025.08.16.00
 */
final class TgSuggestedPostParameters{
  /**
   * @param TgCurrencies $Currency Currency in which the post will be paid. Currently, must be one of “XTR” for Telegram Stars or “TON” for toncoins
   * @param int $Amount The amount of the currency that will be paid for the post in the smallest units of the currency, i.e. Telegram Stars or nanotoncoins. Currently, price in Telegram Stars must be between 5 and 100000, and price in nanotoncoins must be between 10000000 and 10000000000000.
   * @param int $SendDate Proposed send date of the post. If specified, then the date must be between 300 second and 2678400 seconds (30 days) in the future. If the field is omitted, then the post can be published at any time within 30 days at the sole discretion of the user who approves it.
   */
  public function __construct(
    public TgCurrencies|null $Currency = null,
    public int|null $Amount = null,
    public int|null $SendDate = null
  ){}

  public function ToArray():array{
    $param = [];
    if($this->Currency !== null):
      $param['price']['currency'] = $this->Currency->value;
    endif;
    if($this->Amount !== null):
      $param['price']['amount'] = $this->Amount;
    endif;
    if($this->SendDate !== null):
      $param['send_date'] = $this->SendDate;
    endif;
    return $param;
  }
}