<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * This object contains information about the chat whose identifier was shared with the bot using a KeyboardButtonRequestChat button.
 * @link https://core.telegram.org/bots/api#chatshared
 * @version 2023.05.23.00
 */
final class TgChatShared
extends TgObject{
  public readonly TgMessageData $Data;
  /**
   * Identifier of the request
   */
  public readonly int $Id;
  /**
   * Identifier of the shared chat. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier. The bot may not have access to the chat and could be unable to use this identifier, unless the chat is already known to the bot by some other means.
   */
  public readonly int $ChatId;

  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    $this->Id = $Data['chat_shared']['request_id'];
    $this->ChatId = $Data['chat_shared']['chat_id'];
  }
}