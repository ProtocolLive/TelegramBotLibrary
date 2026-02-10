<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#user
 * @version 2026.02.10.00
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
  /**
   * If the bot can be connected to a Telegram Business account to receive its messages. Returned only in getMe.
   */
  public bool $Business;
  /**
   * If the bot has a main Web App. Returned only in getMe.
   */
  public bool $WebApp;
  /**
   * If the bot allows users to create and delete topics in private chats. Returned only in getMe.
   */
  public bool $Topics;

  public function __construct(
    array $Data
  ){
    $this->Id = $Data['id'];
    $this->Name = $Data['first_name'];
    $this->Nick = $Data['username'];
    $this->Groups = $Data['can_join_groups'] ?? false;
    $this->Read = $Data['can_read_all_group_messages'] ?? false;
    $this->InlineQuery = $Data['supports_inline_queries'] ?? false;
    $this->Business = $Data['can_connect_to_business'] ?? false;
    $this->WebApp = $Data['has_main_web_app'] ?? false;
    $this->Topics = $Data['allows_users_to_create_topics'] ?? false;
  }
}