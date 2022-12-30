<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.12.30.01

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#callbackquery
 */
final class TgCallback{
  /**
   * Message with the callback button that originated the query. Note that message content and message date will not be available if the message is too old
   */
  public readonly TgText $Data;
  /**
   * Unique identifier for this query
   */
  public readonly int $Id;
  /**
   * Sender
   */
  public readonly TgUser $User;
  /**
   * Global identifier, uniquely corresponding to the chat to which the message with the callback button was sent. Useful for high scores in games.
   */
  public readonly string $ChatInstance;
  /**
   * Data associated with the callback button. Be aware that the message originated the query can contain no callback buttons with this data.
   */
  public readonly string $Callback;

  public function __construct(array $Data){
    $this->Id = $Data['id'];
    $this->User = new TgUser($Data['from']);
    $this->Data = new TgText($Data['message']);
    $this->ChatInstance = $Data['chat_instance'];
    $this->Callback = $Data['data'];
  }
}