<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * Describes an amount of Telegram Stars.
 * @link https://core.telegram.org/bots/api#staramount
 * @version 2025.04.11.00
 */
final readonly class TgStarAmount{
  public int $Amount;
  public int $NanoAmount;

  public function __construct(
    array $Data
  ){
    $this->Amount = $Data['amount'];
    $this->NanoAmount = $Data['nanostar_amount'];
  }
}