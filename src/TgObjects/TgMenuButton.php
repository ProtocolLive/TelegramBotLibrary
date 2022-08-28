<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

enum TgMenuButton:string{
  case Default = 'default';
  case Commands = 'commands';
  case WebApp = 'web_app';
}