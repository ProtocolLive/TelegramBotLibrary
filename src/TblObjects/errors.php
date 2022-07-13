<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.07.13.01
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
  case NoEvent;
  case TokenWebhook;
}

class TblException extends Exception{}
class TblExtensionException extends TblException{}