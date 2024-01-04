<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#user
 * @version 2024.01.04.00
 */
final readonly class TgBot{
  /**
   * Unique identifier for this user or bot. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
   */
  public int $Id;
  /**
   * User's or bot's first name
   */
  public string $Name;
  /**
   * User's or bot's username
   */
  public string $Nick;
  /**
   * If the bot can be invited to groups. Returned only in getMe.
   */
  public bool $Groups;
  /**
   * If privacy mode is disabled for the bot. Returned only in getMe.
   */
  public bool $Read;
  /**
   * If the bot supports inline queries. Returned only in getMe.
   */
  public bool $InlineQuery;

  public function __construct(
    array $Data
  ){
    $this->Id = $Data['id'];
    $this->Name = $Data['first_name'];
    $this->Nick = $Data['username'];
    $this->Groups = $Data['can_join_groups'];
    $this->Read = $Data['can_read_all_group_messages'];
    $this->InlineQuery = $Data['supports_inline_queries'];
  }
}