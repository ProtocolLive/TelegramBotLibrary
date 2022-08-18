<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#formatting-options
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