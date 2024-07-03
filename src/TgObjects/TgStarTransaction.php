<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\{
  TgTransactionPartner,
  TgTransactionPartnerAds,
  TgTransactionPartnerFragment,
  TgTransactionPartnerOther,
  TgTransactionPartnerUser
};

/**
 * Describes a Telegram Star transaction.
 * @link https://core.telegram.org/bots/api#startransaction
 * @version 2024.07.01.00
 */
final readonly class TgStarTransaction{
  /**
   * Unique identifier of the transaction. Coincides with the identifier of the original transaction for refund transactions. Coincides with SuccessfulPayment.telegram_payment_charge_id for successful incoming payments from users.
   */
  public string $Id;
  /**
   * Number of Telegram Stars transferred by the transaction
   */
  public int $Amount;
  /**
   * Date the transaction was created in Unix time
   */
  public int $Date;
  /**
   * Source of an incoming transaction (e.g., a user purchasing goods or services, Fragment refunding a failed withdrawal). Only for incoming transactions
   */
  public TgTransactionPartner|null $Source;
  /**
   * Receiver of an outgoing transaction (e.g., a user for a purchase refund, Fragment for a withdrawal). Only for outgoing transactions
   */
  public TgTransactionPartner|null $Receiver;

  public function __construct(
    array $Data
  ){
    $this->Id = $Data['id'];
    $this->Amount = $Data['amount'];
    $this->Date = $Data['date'];
    if($Data['source']['type'] === 'user'):
      $this->Source = new TgTransactionPartnerUser($Data['source']);
    elseif($Data['source']['type'] === 'fragment'):
      $this->Source = new TgTransactionPartnerFragment($Data['source']);
    elseif($Data['source']['type'] === 'telegram_ads'):
      $this->Source = new TgTransactionPartnerAds;
    elseif($Data['source']['type'] === 'other'):
      $this->Source = new TgTransactionPartnerOther;
    endif;
  }
}