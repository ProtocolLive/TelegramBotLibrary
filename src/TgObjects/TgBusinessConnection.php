<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgUser;

/**
 * @version 2024.03.31.00
 * @link https://core.telegram.org/bots/api#businessconnection
 */
final readonly class TgBusinessConnection
implements TgEventInterface{
  public TgMessageData $Data;
  /**
   * Identifier of a private chat with the user who created the business connection. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
   */
  public int $UserId;
  /**
   * Date the connection was established in Unix time
   */
  public int $Date;
  /**
   * If the bot can act on behalf of the business account in chats that were active in the last 24 hours
   */
  public bool $Reply;
  /**
   * If the connection is active
   */
  public bool $Enabled;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->UserId = $Data['user_chat_id'];
    $this->Date = $Data['date'];
    $this->Reply = $Data['can_reply'];
    $this->Enabled = $Data['is_enabled'];
  }
}