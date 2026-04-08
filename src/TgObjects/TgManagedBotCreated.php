<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * This object contains information about the bot that was created to be managed by the current bot.
 * @link https://core.telegram.org/bots/api#managedbotcreated
 * @version 2026.04.08.00
 */
final readonly class TgManagedBotCreated{
  /**
   * Information about the bot. The bot's token can be fetched using the method getManagedBotToken.
   */
  public TgBot $Bot;

  public function __construct(
    array $Data
  ){
    $this->Bot = new TgBot($Data['bot']);
  }
}