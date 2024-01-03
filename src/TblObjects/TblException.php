<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use Exception;

/**
 * version 2024.01.03.00
 */
class TblException
extends Exception{
  /**
   * @param TblError|TgException $code The Exception code.
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