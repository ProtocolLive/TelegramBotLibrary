<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\{
  TgBusinessRights,
  TgMessageData
};
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * @version 2024.04.11.00
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
   * If the connection is active
   */
  public bool $Enabled;
  /**
   * Rights of the business bot
   */
  public TgBusinessRights $Rights;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->UserId = $Data['user_chat_id'];
    $this->Date = $Data['date'];
    $this->Enabled = $Data['is_enabled'];
    $this->Rights = new TgBusinessRights($Data['rights']);
  }
}