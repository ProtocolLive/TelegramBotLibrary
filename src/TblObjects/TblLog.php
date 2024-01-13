<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2024.01.13.00

namespace ProtocolLive\TelegramBotLibrary\TblObjects;

class TblLog{
  const All = -1;
  const None = 0;
  const Send = 1;
  const Response = 2;
  const Webhook = 4;
  const WebhookObject = 8;
  const Curl = 16;
}