<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgEnums;

/**
 * @version 2024.07.01.00
 */
enum TgRevenueWithdrawalState:string{
  case Pending = 'pending';
  case Succeeded = 'succeeded';
  case Failed = 'failed';
}