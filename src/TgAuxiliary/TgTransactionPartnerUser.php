<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgPaidMedia;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgUser;

/**
 * Describes a transaction with a user.
 * @link https://core.telegram.org/bots/api#transactionpartneruser
 * @version 2024.11.17.00
 */
final readonly class TgTransactionPartnerUser
extends TgTransactionPartner{
  /**
   * Information about the user
   */
  public TgUser $User;
  /**
   * Bot-specified invoice payload
   */
  public string|null $Payload;
  /**
   * Information about the paid media bought by the user
  * @var TgPaidMedia[]
   */
  public array|null $PaidMedia;
  /**
   * The duration of the paid subscription
   */
  public int|null $SubscriptionPeriod;
  /**
   * Information about the affiliate that received a commission via this transaction
   */
  public TgAffiliateInfo|null $Affiliate;

  public function __construct(
    array $Data
  ){
    $this->User = new TgUser($Data['user']);
    $this->Payload = $Data['invoice_payload'] ?? null;
    $this->SubscriptionPeriod = $Data['subscription_period'] ?? null;
    if(isset($Data['paid_media'])):
      foreach($Data['paid_media'] as $media):
        $temp[] = new TgPaidMedia($media);
      endforeach;
      $this->PaidMedia = $temp;
    else:
      $this->PaidMedia = null;
    endif;
  }
}