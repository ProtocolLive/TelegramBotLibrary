<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * This object contains information about the creation, token update, or owner update of a bot that is managed by the current bot.
 * @link https://core.telegram.org/bots/api#managedbotupdated
 * @version 2026.04.08.00
 */
final readonly class TgMask{
  /**
   * User that created the bot
   */
  public TgUser $User;
  /**
   * Information about the bot. Token of the bot can be fetched using the method getManagedBotToken.
   */
  public TgBot $Bot;

  public function __construct(
    array $Data
  ){
    $this->User = new TgUser($Data['user']);
    $this->Bot = new TgBot($Data['bot']);
  }
}