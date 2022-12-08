<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.12.08.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * The group has been migrated to a supergroup with the specified identifier. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
 * @link https://core.telegram.org/bots/api#message
 */
class TgChatMigrateTo{
  public readonly TgUser $Admin;
  public readonly TgChat $Group;
  /**
   * Date the message was sent in Unix time
   */
  public readonly int $Date;
  /**
   * The group has been migrated to a supergroup with the specified identifier. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
   */
  public readonly int $IdNew;

  public function __construct(array $Data){
    $this->Admin = new TgUser($Data['from']);
    $this->Group = new TgChat($Data['chat']);
    $this->Date = $Data['date'];
    $this->IdNew = $Data['migrate_to_chat_id'];
  }
}