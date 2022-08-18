<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

enum TgPollType:string{
  case Regular = 'regular';
  case Quiz = 'quiz';
}