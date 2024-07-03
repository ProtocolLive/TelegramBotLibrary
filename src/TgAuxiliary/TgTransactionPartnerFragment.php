<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgRevenueWithdrawalState;

/**
 * Describes a transaction with Fragment.
 * @link https://core.telegram.org/bots/api#transactionpartnerfragment
 * @version 2024.07.01.00
 */
final readonly class TgTransactionPartnerFragment
extends TgTransactionPartner{
  /**
   * This object describes the state of a revenue withdrawal operation.
   */
  public TgRevenueWithdrawalState $Type;
  /**
   * Date the withdrawal was completed in Unix time
   */
  public int $Date;
  /**
   * An HTTPS URL that can be used to see transaction details
   */
  public string $Url;

  public function __construct(
    array $Data
  ){
    $this->Type = TgRevenueWithdrawalState::from($Data['withdrawal_state']['type']);
    if($this->Type === TgRevenueWithdrawalState::Succeeded):
      $this->Date = $Data['withdrawal_state']['date'];
      $this->Url = $Data['withdrawal_state']['url'];
    endif;
  }
}