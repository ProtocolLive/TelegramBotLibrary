<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.03.03.01

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
  case JsonError;
  /**
   * @link https://core.telegram.org/bots/api#answercallbackquery
   */
  case LimitCallbackAnswer;
  /**
   * @link https://core.telegram.org/bots/api#inlinekeyboardbutton
   */
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