<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * This object contains information about the user whose identifier was shared with the bot using a KeyboardButtonRequestUser button.
 * @link https://core.telegram.org/bots/api#usershared
 * @version 2024.01.04.00
 */
final readonly class TgUsersShared
implements TgEventInterface{
  public TgMessageData $Data;
  /**
   * Identifier of the request
   */
  public int $Id;
  /**
   * Identifiers of the shared users. These numbers may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting them. But they have at most 52 significant bits, so 64-bit integers or double-precision float types are safe for storing these identifiers. The bot may not have access to the users and could be unable to use these identifiers, unless the users are already known to the bot by some other means.
   */
  public array $Users;

  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    $this->Id = $Data['users_shared']['request_id'];
    $this->Users = $Data['users_shared']['user_ids'];
  }
}