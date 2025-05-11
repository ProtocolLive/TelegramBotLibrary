<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgChat;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgUser;

/**
 * Contains information about the affiliate that received a commission via this transaction.
 * @link https://core.telegram.org/bots/api#affiliateinfo
 * @version 2025.05.11.00
 */
final readonly class TgAffiliateInfo{
  /**
   * The bot or the user that received an affiliate commission if it was received by a bot or a user
   */
  public TgUser|null $User;
  /**
   * The chat that received an affiliate commission if it was received by a chat
   */
  public TgChat|null $Chat;
  /**
   * The number of Telegram Stars received by the affiliate for each 1000 Telegram Stars received by the bot from referred users
   */
  public int $Commision;
  /**
   * Integer amount of Telegram Stars received by the affiliate from the transaction, rounded to 0; can be negative for refunds
   */
  public int $Starts;
  /**
   * The number of 1/1000000000 shares of Telegram Stars received by the affiliate; from -999999999 to 999999999; can be negative for refunds
   */
  public int|null $Nano;

  public function __construct(
    array $Data
  ){
    if(isset($Data['affiliate_user'])):
      $this->User = new TgUser($Data['affiliate_user']);
    endif;
    if(isset($Data['affiliate_chat'])):
      $this->Chat = new TgChat($Data['affiliate_chat']);
    endif;
    $this->Commision = $Data['commission_per_mille'];
    $this->Starts = $Data['amount'];
    $this->Nano = $Data['nanostar_amount'] ?? null;
  }
}