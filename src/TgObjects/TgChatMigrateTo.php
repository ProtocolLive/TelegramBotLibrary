<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * The group has been migrated to a supergroup with the specified identifier. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
 * @link https://core.telegram.org/bots/api#message
 * @version 2024.07.07.00
 */
final readonly class TgChatMigrateTo
implements TgEventInterface{
  public TgMessageData $Data;
  /**
   * Date the message was sent in Unix time
   */
  public int $Date;
  /**
   * The group has been migrated to a supergroup with the specified identifier. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
   */
  public int $IdNew;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Date = $Data['date'];
    $this->IdNew = $Data['migrate_to_chat_id'];
  }
}