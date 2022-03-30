<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.03.30.00

enum TgError{
  case CallbackQueryOld;
}

class TgErrors{
  private const Errors = [
    'Bad Request: query is too old and response timeout expired or query ID is invalid' => TgError::CallbackQueryOld
  ];

  static public function Search(string $Description):TgError|false{
    return self::Errors[$Description] ?? false;
  }
}