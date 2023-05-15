<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.05.15.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

enum TgError{
  case Banned;
  case Blocked;
  case BotBot;
  case ButtonIdInvalid;
  case CallbackQueryOld;
  case CantDelete;
  case ChatAdministratorRightsObject;
  case ChatNotFound;
  case CopyNotFound;
  case Deleted;
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
  case MessageIdInvalid;
  case NotMember;
  case NoMedia;
  case PermAdminManage;
  case Protected;
  case SomethingMissing;
  case TextButtonNo;
  case TooMany;
  case UnpinNotFound;
  case UrlFailed;
  case UrlInvalid;
  case UrlShort;
  case UserObject;
  case UserNotFound;
  case WebAppHttps;
}