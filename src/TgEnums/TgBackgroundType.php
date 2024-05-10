<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgEnums;

/**
 * @link https://core.telegram.org/bots/api#backgroundtype
 * @version 2024.05.06.00
 */
enum TgBackgroundType:string{
  case Fill = 'fill';
  case Wallpaper = 'wallpaper';
  case Pattern = 'pattern';
  case Theme = 'chat_theme';
}