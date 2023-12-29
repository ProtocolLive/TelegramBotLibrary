<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @version 2023.12.29.01
 */
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
  /**
   * https://core.telegram.org/bots/api#copymessages
   */
  const MessagesCopy = 100;
  /**
   * @link https://core.telegram.org/bots/api#deletemessages
   */
  const MessagesDelete = 100;
  /**
   * https://core.telegram.org/bots/api#forwardmessages
   */
  const MessagesForward = 100;
  /**
   * @link https://core.telegram.org/bots/api#setmydescription
   */
  const Description = 512;
  /**
   * @link https://core.telegram.org/bots/api#setmyshortdescription
   */
  const DescriptionShort = 120;
  const MediaGroup = 10;
  /**
   * @link https://core.telegram.org/bots/api#setmyname
   */
  const Name = 64;
  /**
   * @link https://core.telegram.org/bots/api#replyparameters
   */
  const Quote = 1024;
  const Text = 4096;
}