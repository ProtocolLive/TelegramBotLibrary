<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgEnums;

/**
 * @version 2024.07.04.00
 */
enum TgError{
  case Admin;
  case Banned;
  case Blocked;
  case BotBot;
  case ButtonIdInvalid;
  case CallbackQueryOld;
  case CantDelete;
  case CantEdit;
  case ChatAdministratorRightsObject;
  case ChatNotFound;
  case CopyNotFound;
  case Deleted;
  case EditNotFound;
  case EditSame;
  case EntityParse;
  case ForwardCant;
  case GameScore;
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
  /**
   * @link https://core.telegram.org/bots/api#sendpoll
   */
  case LimitPollExplanation;
  /**
   * @link https://core.telegram.org/bots/api#sendpoll
   */
  case LimitPollOptionsMax;
  /**
   * @link https://core.telegram.org/bots/api#sendpoll
   */
  case LimitPollOptionsMin;
  /**
   * @link https://core.telegram.org/bots/api#inputpolloption
   */
  case LimitPollOptionText;
  /**
   * @link https://core.telegram.org/bots/api#sendpoll
   */
  case LimitPollQuestion;
  case LinkPreview;
  case Markdown;
  case MessageIdInvalid;
  case MissingParameter;
  case NotMember;
  case NoMedia;
  case PermAdminManage;
  case Protected;
  case Quote;
  case ReactionMsgNotFound;
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
  case Webhook;
}