<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TblObjects;

enum TblLog{
  case Error;
  case Webhook;
  case Send;
  case Response;
}