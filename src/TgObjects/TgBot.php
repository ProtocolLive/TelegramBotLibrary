<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#user
 * @version 2026.06.13.00
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
  public bool|null $Groups;
  /**
   * If privacy mode is disabled for the bot. Returned only in getMe.
   */
  public bool|null $Read;
  /**
   * If the bot supports inline queries. Returned only in getMe.
   */
  public bool|null $InlineQuery;
  /**
   * If the bot can be connected to a Telegram Business account to receive its messages. Returned only in getMe.
   */
  public bool|null $Business;
  /**
   * If the bot has a main Web App. Returned only in getMe.
   */
  public bool|null $WebApp;
  /**
   * If the bot allows users to create and delete topics in private chats. Returned only in getMe.
   */
  public bool|null $Topics;
  /**
   * If other bots can be created to be controlled by the bot. Returned only in getMe.
   */
  public bool|null $ManageBots;
  /**
   * If the bot supports guest queries from chats it is not a member of. Returned only in getMe.
   */
  public bool|null $Guest;
  /**
   * If the bot supports join request queries and can be assigned to process them. Returned only in getMe.
   */
  public bool|null $Guardian;

  public function __construct(
    array $Data
  ){
    $this->Id = $Data['id'];
    $this->Name = $Data['first_name'];
    $this->Nick = $Data['username'];
    $this->Groups = $Data['can_join_groups'] ?? null;
    $this->Read = $Data['can_read_all_group_messages'] ?? null;
    $this->InlineQuery = $Data['supports_inline_queries'] ?? null;
    $this->Business = $Data['can_connect_to_business'] ?? null;
    $this->WebApp = $Data['has_main_web_app'] ?? null;
    $this->Topics = $Data['allows_users_to_create_topics'] ?? null;
    $this->ManageBots = $Data['can_manage_bots'] ?? null;
    $this->Guest = $Data['supports_guest_queries'] ?? null;
    $this->Guardian = $Data['supports_join_request_queries'] ?? null;
  }
}