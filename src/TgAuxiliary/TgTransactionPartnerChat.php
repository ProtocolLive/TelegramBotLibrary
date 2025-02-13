<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgChat;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgGift;

/**
 * Describes a transaction with an unknown source or recipient.
 * @link https://core.telegram.org/bots/api#transactionpartnerother
 * @version 2025.02.13.00
 */
final readonly class TgTransactionPartnerChat
extends TgTransactionPartner{
  public TgChat $Chat;
  public TgGift $Gift;

  public function __construct(
    array $Data
  ){
    $this->Chat = new TgChat($Data['chat']);
    $this->Gift = new TgGift($Data['gift']);
  }
}