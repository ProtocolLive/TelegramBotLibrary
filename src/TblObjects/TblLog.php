<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TblInterfaces\TblLogInterface;

/**
 * @version 2025.06.29.00
 */
enum TblLog
implements TblLogInterface{
  case All;
  case Send;
  case Response;
  case Webhook;
  case WebhookObject;
  case Curl;
}