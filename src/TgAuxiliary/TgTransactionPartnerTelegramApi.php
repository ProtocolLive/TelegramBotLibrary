<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;

/**
 * Describes a transaction with payment for paid broadcasting.
 * @link https://core.telegram.org/bots/api#transactionpartnertelegramapi
 * @version 2024.11.01.00
 */
final readonly class TgTransactionPartnerTelegramApi
extends TgTransactionPartner{
  public int $Count;

  public function __construct(
    array $Data
  ){
    $this->Count = $Data['request_count'];
  }
}