<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgUser;

/**
 * Describes a transaction with a user.
 * @link https://core.telegram.org/bots/api#transactionpartneruser
 * @version 2024.07.01.00
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

  public function __construct(
    array $Data
  ){
    $this->User = new TgUser($Data['user']);
    $this->Payload = $Data['invoice_payload'] ?? null;
  }
}