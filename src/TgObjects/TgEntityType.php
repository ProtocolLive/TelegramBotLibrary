<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @version 2023.12.29.01
 */
enum TgEntityType:string{
  case Bold = 'bold';
  case Cashtag = 'cashtag';
  /**
   * Monowidth string
   */
  case Code = 'code';
  case Command = 'bot_command';
  case CustomEmoji = 'custom_emoji';
  case Email = 'email';
  case Hashtag = 'hashtag';
  case Italic = 'italic';
  /**
   * For clickable text URLs
   */
  case Link = 'text_link';
  case Mention = 'mention';
  /**
   * For users without usernames
   */
  case MentionText = 'text_mention';
  /**
   * Monowidth block
   */
  case Pre = 'pre';
  case Phone = 'phone_number';
  case Quote = 'blockquote';
  case Spoiler = 'spoiler';
  case Strike = 'strikethrough';
  case Underline = 'underline';
  case Url = 'url';
}