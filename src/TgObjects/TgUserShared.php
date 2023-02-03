<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.02.03.01

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * This object contains information about the user whose identifier was shared with the bot using a KeyboardButtonRequestUser button.
 * @link https://core.telegram.org/bots/api#usershared
 */
final class TgUserShared{
  public readonly TgMessageData $Data;
  /**
   * Identifier of the request
   */
  public readonly int $Id;
  /**
   * Identifier of the shared user. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier. The bot may not have access to the user and could be unable to use this identifier, unless the user is already known to the bot by some other means.
   */
  public readonly int $UserId;

  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    $this->Id = $Data['user_shared']['request_id'];
    $this->UserId = $Data['user_shared']['user_id'];
  }
}