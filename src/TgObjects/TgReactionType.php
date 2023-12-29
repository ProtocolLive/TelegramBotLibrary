<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#reactiontype
 * @version 2023.12.29.00
 */
enum TgReactionType:string{
  case Normal = 'emoji';
  case Custom = 'custom_emoji';
}