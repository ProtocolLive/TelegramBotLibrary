<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgEnums;

/**
 * @link https://core.telegram.org/bots/api#suggestedpostinfo
 * @version 2025.08.17.00
 */
enum TgSuggestedPostInfoState:string{
  case Approved = 'approved';
  case Declined = 'declined';
  case Pending = 'pending';
}