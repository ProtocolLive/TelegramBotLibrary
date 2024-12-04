<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgUser;

/**
 * Describes the affiliate program that issued the affiliate commission received via this transaction.
 * @link https://core.telegram.org/bots/api#transactionpartneraffiliateprogram
 * @version 2024.12.04.00
 */
final readonly class TgTransactionPartnerAffiliateProgram
extends TgTransactionPartner{
  /**
   * Information about the bot that sponsored the affiliate program
   */
  public TgUser|null $User;
  /**
   * The number of Telegram Stars received by the bot for each 1000 Telegram Stars received by the affiliate program sponsor from referred users
   */
  public int $Commision;

  public function __construct(
    array $Data
  ){
    $this->Commision = $Data['commission_per_mille'];
    if(isset($Data['sponsor_user'])):
      $this->User = new TgUser($Data['sponsor_user']);
    endif;
  }
}