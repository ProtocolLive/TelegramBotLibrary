<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgError;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgLimits;

/**
 * @version 2026.07.14.00
 */
final class TblCommand{
  public function __construct(
    public string $Command,
    public string $Description,
    public bool $Ephemeral = false
  ){
    if(strlen($Command) > TgLimits::Command):
      throw new TblException(
        TgError::LimitCommand,
        'Command exceeds ' . TgLimits::Command . ' characters'
      );
    endif;
    if(strlen($Description) > TgLimits::CmdDescription):
      throw new TblException(
        TgError::LimitCmdDescription,
        'Description exceeds ' . TgLimits::CmdDescription . ' characters'
      );
    endif;
  }
}