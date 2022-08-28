<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

enum TgChatType:string{
  case Private = 'private';
  case Group = 'group';
  case GroupSuper = 'supergroup';
  case Channel = 'channel';
  case InlineQuery = 'sender';
}