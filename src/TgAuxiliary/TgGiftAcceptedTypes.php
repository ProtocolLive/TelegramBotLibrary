<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;

/**
 * This object describes the types of gifts that can be gifted to a user or a chat.
 * @link https://core.telegram.org/bots/api#acceptedgifttypes
 * @version 2025.05.11.00
 */
final readonly class TgGiftAcceptedTypes{
  public bool $Unlimited;
  public bool $Limited;
  public bool $Unique;
  public bool $Premium;

  public function __construct(
    array $Data
  ){
    $this->Unlimited = $Data['unlimited_gifts'];
    $this->Limited = $Data['limited_gifts'];
    $this->Unique = $Data['unique_gifts'];
    $this->Premium = $Data['premium_subscription'];
  }
}