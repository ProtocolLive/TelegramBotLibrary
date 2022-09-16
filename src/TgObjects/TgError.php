<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.09.16.01

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

enum TgError{
  case BotBot;
  case Blocked;
  case CallbackQueryOld;
  case ChatNotFound;
  case CopyNotFound;
  case EditSame;
  case EntityParse;
  case ForwardCant;
  case FileId;
  case Html;
  case InlineId;
  case InlineQueryClosing;
  case InlineQueryMessage;
  case InlineQueryResult;
  case InlineQueryStringEnd;
  case InlineQueryThumbEmpty;
  case InlineQueryThumbMiss;
  case InlineQueryThumbType;
  case InlineKeyboardNone;
  case InvoiceLabel;
  case InvoiceLimits;
  case PermAdminManage;
  case SomethingMissing;
  case TextButtonNo;
  case TooMany;
  case UrlFailed;
  case UrlInvalid;
  case UrlShort;
  case UserObject;
  case WebAppHttps;
}