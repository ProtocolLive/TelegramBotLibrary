<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgEnums;

/**
 * @link https://core.telegram.org/bots/api#uniquegiftmodel
 * @version 2026.02.27.00
 */
enum TgGiftUniqueModelRarity:string{
  case Uncommon = 'uncommon';
  case Rare = 'rare';
  case Epic = 'epic';
  case Legendary = 'legendary';
}