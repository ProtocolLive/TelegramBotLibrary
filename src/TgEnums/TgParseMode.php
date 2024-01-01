<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgEnums;

/**
 * @link https://core.telegram.org/bots/api#formatting-options
 * @version 2024.01.01.00
 */
enum TgParseMode:string{
  /**
   * @link https://core.telegram.org/bots/api#markdownv2-style
   */
  case Markdown2 = 'MarkdownV2';
  /**
   * @link https://core.telegram.org/bots/api#html-style
   */
  case Html = 'HTML';
  /**
   * @link https://core.telegram.org/bots/api#markdown-style
   */
  case Markdown = 'Markdown';
}