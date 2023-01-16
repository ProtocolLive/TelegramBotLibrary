<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.01.16.00

namespace ProtocolLive\TelegramBotLibrary\TblObjects;

abstract class TblInlineQuery{
  abstract public function ToArray():array;
}