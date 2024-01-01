<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgEnums;

/**
 * @link https://core.telegram.org/bots/api#chatboostsource
 * @version 2024.01.01.00
 */
enum TgBoostSource:string{
  case Gift = 'gift_code';
  case Giveaway = 'giveaway';
  case Premium = 'premium';
}