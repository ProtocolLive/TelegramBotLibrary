<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgEnums;

/**
 * This object describes the type of a reaction.
 * @link https://core.telegram.org/bots/api#reactiontype
 * @version 2024.08.14.00
 */
enum TgReactionType:string{
  case Normal = 'emoji';
  case Custom = 'custom_emoji';
  case Paid = 'paid';
}