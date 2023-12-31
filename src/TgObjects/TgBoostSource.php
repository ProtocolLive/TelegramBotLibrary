<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#chatboostsource
 * @version 2023.12.30.00
 */
enum TgBoostSource:string{
  case Gift = 'gift_code';
  case Giveaway = 'giveaway';
  case Premium = 'premium';
}