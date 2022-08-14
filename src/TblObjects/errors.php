<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.14.00
//API 6.1

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
  case LimitCmdDescription;
  case LimitCommand;
  case LimitPhotoCaption;
  case NoEvent;
  case TokenWebhook;
}

class TblException extends Exception{
  /**
   * @param TblError $code The Exception code.
   * @param string $message [optional] The Exception message to throw.
   * @param Throwable|null $previous [optional] The previous throwable used for the exception chaining.
   * @return void
   */
  public function __construct(
    protected $code,
    protected $message = null,
    protected Throwable|null $previous = null
  ){}
}