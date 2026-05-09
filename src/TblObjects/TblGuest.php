<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgChat,
  TgUser
};

/**
 * @version 2026.05.08.00
 */
final readonly class TblGuest{
  /**
   * @param string $Id The unique identifier for the guest query. Use this identifier with the method answerGuestQuery to send a response message. If non-empty, the message belongs to the chat where the guest bot was summoned, which may not coincide with other existing bot chats sharing the same identifier.
   * @param TgUser|TgChat $Origin For a message sent by a guest bot, this is the user whose original message triggered the bot's response
   */
  public function __construct(
    public string|null $Id = null,
    public TgUser|TgChat|null $Origin = null
  ){}
}