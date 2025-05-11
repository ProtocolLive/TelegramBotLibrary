<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgEnums;

/**
 * @link https://core.telegram.org/bots/api#uniquegiftinfo
 * @version 2025.05.11.00
 */
enum TgGiftUniqueOrigin:string{
  case Transfer = 'transfer';
  case Upgrade = 'upgrade';
}