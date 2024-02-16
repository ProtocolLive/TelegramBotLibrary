<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgChatType;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgForwadableInterface
};

/**
 * @link https://core.telegram.org/bots/api#story
 * @version 2024.02.16.00
 */
final readonly class TgStory
implements TgEventInterface, TgForwadableInterface{
  public TgMessageData $Data;
  /**
   * Chat that posted the story
   */
  public TgChat|TgUser $Chat;
  /**
   * Unique identifier for the story in the chat
   */
  public int $Id;

  /**
   * This object represents a message about a forwarded story in the chat. Currently holds no information.
   * @link https://core.telegram.org/bots/api#story
   */
  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    if($Data['story']['chat']['type'] === TgChatType::Private->value):
      $this->Chat = new TgUser($Data['story']['chat']);
    else:
      $this->Chat = new TgChat($Data['story']['chat']);
    endif;
    $this->Id = $Data['story']['id'];
  }
}