<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.06.21.00
//API 6.1

enum TblError{
  case Curl;
  case Custom;
  case InlineButtonLoginSsl;
  case InvoicePriceEmpty;
  case InvoicePriceHigh;
  case InvoicePriceLow;
  case LimitCallbackData;
  case LimitCmdDescription;
  case LimitCommand;
  case LimitPhotoCaption;
  case NoCurl;
  case NoEvent;
  case NoSsl;
  case TokenWebhook;
}