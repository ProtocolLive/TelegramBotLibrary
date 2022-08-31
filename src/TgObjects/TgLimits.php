<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.31.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

class TgLimits{
  const CallbackAnswer = 200;
  const CallbackData = 64;
  const Caption = 1024;
  /**
   * Text of the command; 1-32 characters. Can contain only lowercase English letters, digits and underscores.
   * @link https://core.telegram.org/bots/api#botcommand
   */
  const Command = 32;
  /**
   * Description of the command; 1-256 characters.
   * @link https://core.telegram.org/bots/api#botcommand
   */
  const CmdDescription = 256;
  const MediaGroup = 10;
  const Text = 4096;
}