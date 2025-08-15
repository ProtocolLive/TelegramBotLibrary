<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgUser;

/**
 * @link https://core.telegram.org/bots/api#directmessagestopic
 * @version 2025.08.15.00
 */
final readonly class TgDirectMessagesTopic{
  /**
   * Unique identifier of the topic
   */
  public int $Topic;
  /**
   * Information about the user that created the topic
   */
  public TgUser $User;

  public function __construct(
    array $Data
  ){
    $this->Topic = $Data['topic_id'];
    $this->User = new TgUser($Data['user']);
  }
}