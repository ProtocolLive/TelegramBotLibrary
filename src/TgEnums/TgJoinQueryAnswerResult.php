<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgEnums;

/**
 * @link https://core.telegram.org/bots/api#answerchatjoinrequestquery
 * @version 2026.06.11.00
 */
enum TgJoinQueryAnswerResult:string{
  case Approve = 'approve';
  case Decline = 'decline';
  case Queue = 'queue';
}