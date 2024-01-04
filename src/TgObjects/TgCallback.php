<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblBasics;

/**
 * @link https://core.telegram.org/bots/api#callbackquery
 * @version 2024.01.04.00
 */
final class TgCallback{
  /**
   * Message with the callback button that originated the query. Note that message content and message date will not be available if the message is too old
   */
  public readonly TgText|TgPhoto|null $Data;
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
   * Identifier of the message sent via the bot in inline mode, that originated the query.
   */
  public readonly string|null $InlineMessageId;
  /**
   * Data associated with the callback button. Be aware that the message originated the query can contain no callback buttons with this data.
   */
  public readonly string $Callback;

  public function __construct(
    array $Data
  ){
    $this->Id = $Data['id'];
    $this->User = new TgUser($Data['from']);
    if(isset($Data['message'])):
      $this->Data = TblBasics::DetectMessage($Data['message']);
    else:
      $this->Data = null;
    endif;
    $this->ChatInstance = $Data['chat_instance'];
    $this->Callback = $Data['data'];
    $this->InlineMessageId = $Data['inline_message_id'] ?? null;
  }
}