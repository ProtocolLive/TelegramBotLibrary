<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.19.00

namespace ProtocolLive\TelegramBotLibrary\TblObjects;

class TblException extends \Exception{
  /**
   * @param TblError $code The Exception code.
   * @param string $message [optional] The Exception message to throw.
   * @param Throwable|null $previous [optional] The previous throwable used for the exception chaining.
   * @return void
   */
  public function __construct(
    protected $code,
    protected $message = null,
    protected \Throwable|null $previous = null
  ){}
}