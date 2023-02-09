<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.02.09.00

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
  /**
   * https://core.telegram.org/bots/api#answercallbackquery
   */
  case LimitCallbackAnswer;
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
  /**
   * @link https://core.telegram.org/bots/api#sendmessage
   */
  case LimitText;
  case MissingParameter;
  case NoEvent;
  case TokenWebhook;
}