<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.01.29.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

class TgLimits{
  /**
   * @link https://core.telegram.org/bots/api#answercallbackquery
   */
  const CallbackAnswer = 200;
  const CallbackData = 64;
  const Caption = 1024;
  /**
   * @link https://core.telegram.org/bots/api#botcommand
   */
  const Command = 32;
  /**
   * @link https://core.telegram.org/bots/api#botcommand
   */
  const CmdDescription = 256;
  const MediaGroup = 10;
  const Text = 4096;
}