<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;

/**
 * This object describes the types of gifts that can be gifted to a user or a chat.
 * @link https://core.telegram.org/bots/api#acceptedgifttypes
 * @version 2026.02.09.00
 */
final readonly class TgGiftAcceptedTypes{
  /**
   * If unlimited regular gifts are accepted
   */
  public bool $Unlimited;
  /**
   * If limited regular gifts are accepted
   */
  public bool $Limited;
  /**
   * If unique gifts or gifts that can be upgraded to unique for free are accepted
   */
  public bool $Unique;
  /**
   * If a Telegram Premium subscription is accepted
   */
  public bool $Premium;
  /**
   * If transfers of unique gifts from channels are accepted
   */
  public bool $Channel;

  public function __construct(
    array $Data
  ){
    $this->Unlimited = $Data['unlimited_gifts'] ?? false;
    $this->Limited = $Data['limited_gifts'] ?? false;
    $this->Unique = $Data['unique_gifts'] ?? false;
    $this->Premium = $Data['premium_subscription'] ?? false;
    $this->Premium = $Data['gifts_from_channels'] ?? false;
  }
}