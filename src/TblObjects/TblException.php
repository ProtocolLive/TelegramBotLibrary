<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use Exception;
use ProtocolLive\TelegramBotLibrary\TblEnums\TblError;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgError;

/**
 * version 2025.06.30.00
 */
class TblException
extends Exception{
  /**
   * @param TblError|TgError $code The Exception code.
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