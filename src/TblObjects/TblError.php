<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.04.24.00

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
  /**
   * @link https://core.telegram.org/bots/api#setmydescription
   */
  case LimitDescription;
  /**
   * @link https://core.telegram.org/bots/api#setmyshortdescription
   */
  case LimitDescriptionShort;
  /**
   * @link https://core.telegram.org/bots/api#setmyname
   */
  case LimitName;
  case LimitPhotoCaption;
  /**
   * @link https://core.telegram.org/bots/api#sendmessage
   */
  case LimitText;
  case MissingParameter;
  case NoEvent;
  case TokenWebhook;
}