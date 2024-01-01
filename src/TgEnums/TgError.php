<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgEnums;

/**
 * @version 2024.01.01.00
 */
enum TgError{
  case Admin;
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
  case Markdown;
  case MessageIdInvalid;
  case NotMember;
  case NoMedia;
  case PermAdminManage;
  case Protected;
  case Quote;
  case SomethingMissing;
  case TextButtonNo;
  case TooBig;
  case TooMany;
  case UnpinNotFound;
  case UrlFailed;
  case UrlInvalid;
  case UrlShort;
  case UserObject;
  case UserNotFound;
  case WebAppHttps;
}