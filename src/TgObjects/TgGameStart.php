<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * @version 2024.01.03.00
 */
final readonly class TgGameStart
implements TgEventInterface{
  public string $Id;
  public TgUser $User;
  /**
   * Identifier of the message sent via the bot in inline mode, that originated the query.
   */
  public string $InlineMessageId;
  /**
   * Global identifier, uniquely corresponding to the chat to which the message with the callback button was sent. Useful for high scores in games.
   */
  public string $ChatInstance;
  /**
   * Short name of a Game to be returned, serves as the unique identifier for the game
   */
  public string $Game;

  public function __construct(
    array $Data
  ){
    $this->Id = $Data['id'];
    $this->User = new TgUser($Data['from']);
    $this->InlineMessageId = $Data['inline_message_id'];
    $this->ChatInstance = $Data['chat_instance'];
    $this->Game = $Data['game_short_name'];
  }
}