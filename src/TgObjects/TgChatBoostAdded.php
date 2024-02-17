<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * Service message: user boosted the chat
 * @link https://core.telegram.org/bots/api#chatboostadded
 * @version 2024.02.16.01
 */
final readonly class TgChatBoostAdded
implements TgEventInterface{
  /**
   * Number of boosts added by the user
   */
  public int $Count;
  
  public function __construct(
    array $Data
  ){
    $this->Count = $Data['boost_count'];
  }
}