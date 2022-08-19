<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.19.00

namespace ProtocolLive\TelegramBotLibrary\TblObjects;

//Debug are int to use binary operators
class TblDebug{
  const All = -1;
  const None = 0;
  const Send = 1;
  const Response = 2;
  const Webhook = 4;
  const Curl = 8;
}