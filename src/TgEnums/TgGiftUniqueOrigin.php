<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgEnums;

/**
 * @link https://core.telegram.org/bots/api#uniquegiftinfo
 * @version 2025.07.04.00
 */
enum TgGiftUniqueOrigin:string{
  case Resale = 'resale';
  case Transfer = 'transfer';
  case Upgrade = 'upgrade';
}