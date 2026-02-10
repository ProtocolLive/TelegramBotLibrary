<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblEnums;

/**
 * @version 2026.02.10.00
 */
enum TblError{
  case ChatEmpty;
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
   * @link https://core.telegram.org/bots/api#createforumtopic
   */
  case LimitName;
  /**
   * @link https://core.telegram.org/bots/api#sendmessage
   */
  case LimitText;
  case MessagesCopy;
  case MessagesDelete;
  case MessagesForward;
  case MissingParameter;
  case NoEvent;
  case TokenWebhook;
  case UnknownUpdate;
}