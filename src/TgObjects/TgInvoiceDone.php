<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgCurrencies;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgServiceInterface
};

/**
 * This object contains basic information about a successful payment.
 * @link https://core.telegram.org/bots/api#successfulpayment
 * @version 2024.11.17.00
 */
final readonly class TgInvoiceDone
implements TgEventInterface,
TgServiceInterface{
  public TgMessageData $Data;
  /**
   * Three-letter ISO 4217 currency code
   */
  public TgCurrencies $Currency;
  /**
   * Total price in the smallest units of the currency (integer, not float/double). For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies).
   */
  public Int $Amount;
  /**
   * Bot specified invoice payload
   */
  public string $Payload;
  /**
   * Order information provided by the user
   */
  public TgInvoiceOrderInfo|null $OrderInfo;
  /**
   * Telegram payment identifier
   */
  public string $PayTelegramId;
  /**
   * Provider payment identifier
   */
  public string $PayProviderId;
  /**
   * Identifier of the shipping option chosen by the user
   */
  public string $ShippingOption;
  /**
   * Expiration date of the subscription, in Unix time; for recurring payments only
   */
  public int|null $SubscriptionExpiration;
  /**
   * If the payment is a recurring payment for a subscription
   */
  public bool $RecurringPayment;
  /**
   * If the payment is the first payment for a subscription
   */
  public bool $FirstRecurring;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Currency = TgCurrencies::tryFrom($Data['successful_payment']['currency']);
    $this->Amount = $Data['successful_payment']['total_amount'];
    $this->Payload = $Data['successful_payment']['invoice_payload'];
    if(isset($Data['successful_payment']['order_info'])):
      $this->OrderInfo = new TgInvoiceOrderInfo($Data['successful_payment']['order_info']);
    else:
      $this->OrderInfo = null;
    endif;
    $this->PayTelegramId = $Data['successful_payment']['telegram_payment_charge_id'];
    $this->PayProviderId = $Data['successful_payment']['provider_payment_charge_id'];
    $this->ShippingOption = $Data['successful_payment']['shipping_option_id'] ?? '';
    $this->SubscriptionExpiration = $Data['successful_payment']['subscription_expiration_date'] ?? null;
    $this->RecurringPayment = $Data['successful_payment']['is_recurring'] ?? false;
    $this->FirstRecurring = $Data['successful_payment']['is_first_recurring'] ?? false;
  }
}