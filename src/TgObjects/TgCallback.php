<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblBasics;

/**
 * @link https://core.telegram.org/bots/api#callbackquery
 * @version 2024.02.11.00
 */
final readonly class TgCallback{
  public TgMessageData $Data;
  /**
   * Message with the callback button that originated the query. Note that message content and message date will not be available if the message is too old
   */
  public TgText|TgPhoto|null $Message;
  /**
   * Global identifier, uniquely corresponding to the chat to which the message with the callback button was sent. Useful for high scores in games.
   */
  public string $ChatInstance;
  /**
   * Identifier of the message sent via the bot in inline mode, that originated the query.
   */
  public string|null $InlineMessageId;
  /**
   * Data associated with the callback button. Be aware that the message originated the query can contain no callback buttons with this data.
   */
  public string $Callback;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    if(isset($Data['message'])):
      $this->Message = TblBasics::DetectMessage($Data['message']);
    else:
      $this->Message = null;
    endif;
    $this->ChatInstance = $Data['chat_instance'];
    $this->Callback = $Data['data'];
    $this->InlineMessageId = $Data['inline_message_id'] ?? null;
  }
}