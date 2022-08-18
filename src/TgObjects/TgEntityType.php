<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

enum TgEntityType:string{
  case Mention = 'mention';
  case Hashtag = 'hashtag';
  case Cashtag = 'cashtag';
  case Command = 'bot_command';
  case CustomEmoji = 'custom_emoji';
  case Url = 'url';
  case Email = 'email';
  case Phone = 'phone_number';
  case Bold = 'bold';
  case Italic = 'italic';
  case Underline = 'underline';
  case Strike = 'strikethrough';
  case Spoiler = 'spoiler';
  /**
   * Monowidth string
   */
  case Code = 'code';
  /**
   * Monowidth block
   */
  case Pre = 'pre';
  /**
   * For clickable text URLs
   */
  case Link = 'text_link';
  /**
   * For users without usernames
   */
  case MentionText = 'text_mention';
}