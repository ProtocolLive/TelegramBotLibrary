<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgEnums;

/**
 * @version 2025.07.03.04
 */
enum TgError{
  case Admin;
  case Balance;
  case Banned;
  case Blocked;
  case BotBot;
  case BusinessInvalid;
  case BusinessPrivate;
  case BusinessSelf;
  case ButtonIdInvalid;
  case CallbackQueryOld;
  case CantDelete;
  case CantEdit;
  /**
   * @link https://core.telegram.org/bots/api#createchatsubscriptioninvitelink
   */
  case ChannelSubscriptionPrice;
  case ChatAdministratorRightsObject;
  case ChatNotFound;
  case ChecklistTaskId;
  case CopyNotFound;
  case Deleted;
  case DontStart;
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
  /**
   * @link https://core.telegram.org/bots/api#createchatsubscriptioninvitelink
   */
  case InviteLinkName;
  case InvoiceLabel;
  case InvoiceLimits;
  /**
   * @link https://core.telegram.org/bots/api#sendphoto
   */
  case LimitCaption;
  /**
   * @link https://core.telegram.org/bots/api#inputchecklist
   */
  case LimitChecklistTasks;
  /**
   * @link https://core.telegram.org/bots/api#inputchecklisttask
   */
  case LimitChecklistTaskText;
  /**
   * @link https://core.telegram.org/bots/api#inputchecklist
   */
  case LimitChecklistTitle;
  /**
   * @link https://core.telegram.org/bots/api#botcommand
   */
  case LimitCommand;
  /**
   * @link https://core.telegram.org/bots/api#botcommand
   */
  case LimitCmdDescription;
  /**
   * @link https://core.telegram.org/bots/api#setmydescription
   */
  case LimitDescription;
  /**
   * @link https://core.telegram.org/bots/api#setmyshortdescription
   */
  case LimitDescriptionShort;
  /**
   * @link https://core.telegram.org/bots/api#setmyname
   */
  case LimitName;
  /**
   * @link https://core.telegram.org/bots/api#sendmediagroup
   */
  case LimitMediaGroup;
  /**
   * @link https://core.telegram.org/bots/api#sendpaidmedia
   */
  case LimitPayload;
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
  case PaidChannel;
  case PaidType;
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