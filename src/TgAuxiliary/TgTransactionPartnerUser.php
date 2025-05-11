<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgTransactionType;
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgGift,
  TgPaidMedia,
  TgUser
};

/**
 * Describes a transaction with a user.
 * @link https://core.telegram.org/bots/api#transactionpartneruser
 * @version 2025.05.11.00
 */
final readonly class TgTransactionPartnerUser
extends TgTransactionPartner{
  /**
   * Type of the transaction
   */
  public TgTransactionType $Type;
  /**
   * Information about the user
   */
  public TgUser $User;
  /**
   * Information about the affiliate that received a commission via this transaction. Can be available only for “invoice_payment” and “paid_media_payment” transactions.
   */
  public TgAffiliateInfo|null $Affiliate;
  /**
   * Bot-specified invoice payload. Can be available only for “invoice_payment” transactions.
   */
  public string|null $PayloadInvoice;
  /**
   * The duration of the paid subscription. Can be available only for “invoice_payment” transactions.
   */
  public int|null $SubscriptionPeriod;
  /**
   * Information about the paid media bought by the user; for “paid_media_payment” transactions only
   * @var TgPaidMedia[]
   */
  public array|null $PaidMedia;
  /**
   * Bot-specified paid media payload. Can be available only for “paid_media_payment” transactions.
   */
  public string|null $PayloadPaidMedia;
  /**
   * The gift sent to the user by the bot; for “gift_purchase” transactions only
   */
  public TgGift|null $Gift;
  /**
   * Number of months the gifted Telegram Premium subscription will be active for; for “premium_purchase” transactions only
   */
  public int|null $PremiumMonths;

  public function __construct(
    array $Data
  ){
    $this->Type = TgTransactionType::from($Data['transaction_type']);
    $this->User = new TgUser($Data['user']);
    if(isset($this->Affiliate)):
      $this->Affiliate = new TgAffiliateInfo($Data['affiliate']);
    else:
      $this->Affiliate = null;
    endif;
    $this->PayloadInvoice = $Data['invoice_payload'] ?? null;
    $this->SubscriptionPeriod = $Data['subscription_period'] ?? null;
    if(isset($Data['paid_media'])):
      foreach($Data['paid_media'] as $media):
        $temp[] = new TgPaidMedia($media);
      endforeach;
      $this->PaidMedia = $temp;
    else:
      $this->PaidMedia = null;
    endif;
    $this->PayloadPaidMedia = $Data['paid_media_payload'] ?? null;
    if(isset($Gift)):
      $this->Gift = new TgGift($Data['gift']);
    else:
      $this->Gift = null;
    endif;
    $this->PremiumMonths = $Data['premium_subscription_duration'] ?? null;
  }
}