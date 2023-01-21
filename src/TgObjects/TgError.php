<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.01.20.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

enum TgError{
  case BotBot;
  case Blocked;
  case CallbackQueryOld;
  case CantDelete;
  case ChatNotFound;
  case CopyNotFound;
  case Deleted;
  case EditSame;
  case EntityParse;
  case ForwardCant;
  case FileId;
  case Html;
  case IdInvalid;
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
  case NotMember;
  case NoMedia;
  case PermAdminManage;
  case SomethingMissing;
  case TextButtonNo;
  case TooMany;
  case UrlFailed;
  case UrlInvalid;
  case UrlShort;
  case UserObject;
  case UserNotFound;
  case WebAppHttps;
}