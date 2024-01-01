<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgEnums;

/**
 * @link https://core.telegram.org/bots/api#reactiontype
 * @version 2024.01.01.00
 */
enum TgReactionType:string{
  case Normal = 'emoji';
  case Custom = 'custom_emoji';
}