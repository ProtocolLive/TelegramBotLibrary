<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.04.19.00

enum TgError{
  case Blocked;
  case CallbackQueryOld;
  case FileId;
  case InlineQueryClosing;
  case InlineQueryMessage;
  case InlineQueryResult;
  case InlineQueryStringEnd;
  case InlineQueryThumbEmpty;
  case InlineQueryThumbMiss;
  case InlineQueryThumbType;
  case UrlFailed;
  case UrlInvalid;
  case UrlShort;
  case PermAdminManage;
  case WebAppHttps;
}

class TgErrors{
  private const Errors = [
    'Forbidden: bot was blocked by the user' => TgError::Blocked,
    'Bad Request: query is too old and response timeout expired or query ID is invalid' => TgError::CallbackQueryOld,
    'Bad Request: failed to get HTTP URL content' => TgError::UrlFailed,
    'Bad Request: WEBDOCUMENT_URL_INVALID' => TgError::UrlInvalid,
    'Bad Request: wrong file identifier\/HTTP URL specified' => TgError::FileId,
    'Bad Request: can\'t parse ChatAdministratorRights: Field \"can_manage_chat\" must be of type Boolean' => TgError::PermAdminManage,
    'Bad Request: can\'t parse inline query result: Field \"thumb_url\" must be of type String' => TgError::InlineQueryThumbType,
    'Bad Request: can\'t parse inline query result: Can\'t find field \"thumb_url\"' => TgError::InlineQueryThumbMiss,
    'Bad Request: can\'t parse inline query result: Inline query result must be an object' => TgError::InlineQueryResult,
    'Bad Request: can\'t parse JSON encoded inline query results: Closing \'\"\' not found' => TgError::InlineQueryClosing,
    'Bad Request: can\'t parse JSON encoded inline query results: Expected string end' => TgError::InlineQueryStringEnd,
    'Bad Request: PHOTO_THUMB_URL_EMPTY' => TgError::InlineQueryThumbEmpty,
    'Bad Request: wrong remote file identifier specified: Wrong string length' => TgError::UrlShort,
    'Bad Request: can\'t parse inline query result: Can\'t find field \"message_text\"' => TgError::InlineQueryMessage
  ];

  static public function Search(string $Description):TgError|false{
    if(isset(self::Errors[$Description])):
      return self::Errors[$Description];
    endif;
    if(strpos($Description, 'Bad Request: menu button web app URL ') === 0
    and strpos($Description, ' is invalid: Only HTTPS links are allowed') !== false):
      return TgError::WebAppHttps;
    endif;
    return false;
  }
}