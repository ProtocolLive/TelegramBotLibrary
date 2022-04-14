<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.04.11.00

enum TgError{
  case Blocked;
  case CallbackQueryOld;
  case FileId;
  case Url;
}

class TgErrors{
  private const Errors = [
    'Forbidden: bot was blocked by the user' => TgError::Blocked,
    'Bad Request: query is too old and response timeout expired or query ID is invalid' => TgError::CallbackQueryOld,
    'Bad Request: failed to get HTTP URL content' => TgError::Url,
    'Bad Request: wrong file identifier\/HTTP URL specified' => TgError::FileId,
  ];

  static public function Search(string $Description):TgError|false{
    return self::Errors[$Description] ?? false;
  }
}