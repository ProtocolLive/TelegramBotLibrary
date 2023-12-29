<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * This object contains information about the user whose identifier was shared with the bot using a KeyboardButtonRequestUser button.
 * @link https://core.telegram.org/bots/api#usershared
 * @version 2023.12.29.00
 */
final class TgUsersShared
extends TgObject{
  public readonly TgMessageData $Data;
  /**
   * Identifier of the request
   */
  public readonly int $Id;
  /**
   * Identifiers of the shared users. These numbers may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting them. But they have at most 52 significant bits, so 64-bit integers or double-precision float types are safe for storing these identifiers. The bot may not have access to the users and could be unable to use these identifiers, unless the users are already known to the bot by some other means.
   */
  public readonly array $Users;

  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    $this->Id = $Data['users_shared']['request_id'];
    $this->Users = $Data['users_shared']['user_ids'];
  }
}