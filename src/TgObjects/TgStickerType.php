<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

enum TgStickerType:string{
  case Regular = 'regular';
  case Mask =  'mask';
  case CustomEmoji = 'custom_emoji';
}