<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.31.00

namespace ProtocolLive\TelegramBotLibrary\TblObjects;

enum TblError{
  case Curl;
  case Custom;
  case ExtensionCurl;
  case ExtensionOpenssl;
  case InlineButtonLoginSsl;
  case InvoicePriceEmpty;
  case InvoicePriceHigh;
  case InvoicePriceLow;
  case LimitCallbackData;
  /**
   * @link https://core.telegram.org/bots/api#botcommand
   */
  case LimitCmdDescription;
  /**
   * @link https://core.telegram.org/bots/api#botcommand
   */
  case LimitCommand;
  case LimitPhotoCaption;
  case NoEvent;
  case TokenWebhook;
}