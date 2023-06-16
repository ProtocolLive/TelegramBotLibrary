<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @version 2023.06.16.00
 */
enum TgMethods:string{
  case CallbackAnswer = 'answerCallbackQuery';
  case Chat = 'getChat';
  case ChatAction = 'sendChatAction';
  case ChatAdms = 'getChatAdministrators';
  case ChatAdmTitle = 'setChatAdministratorCustomTitle';
  case ChatMember = 'getChatMember';
  case ChatMemberBan = 'banChatMember';
  case ChatMemberBanUndo = 'unbanChatMember';
  case ChatMemberCount = 'getChatMemberCount';
  case ChatMemberPerm = 'restrictChatMember';
  case ChatMemberPromote = 'promoteChatMember';
  case ChatMenuButtonGet = 'getChatMenuButton';
  case ChatMenuButtonSet = 'setChatMenuButton';
  case ChatPerm = 'setChatPermissions';
  case CommandsDel = 'deleteMyCommands';
  case CommandsGet = 'getMyCommands';
  case CommandsSet = 'setMyCommands';
  case CustomEmojiGet = 'getCustomEmojiStickers';
  case DescriptionGet = 'getMyDescription';
  case DescriptionSet = 'setMyDescription';
  case DescriptionShortGet = 'getMyShortDescription';
  case DescriptionShortSet = 'setMyShortDescription';
  case DocumentSend = 'sendDocument';
  case FileGet = 'getFile';
  case ForumClose = 'closeForumTopic';
  case ForumCreate = 'createForumTopic';
  case ForumDel = 'deleteForumTopic';
  case ForumEdit = 'editForumTopic';
  case ForumGeneralClose = 'closeGeneralForumTopic';
  case ForumGeneralEdit = 'editGeneralForumTopic';
  case ForumGeneralHide = 'hideGeneralForumTopic';
  case ForumGeneralReopen = 'reopenGeneralForumTopic';
  case ForumGeneralUnhide = 'unhideGeneralForumTopic';
  case ForumReopen = 'reopenForumTopic';
  case ForumStickers = 'getForumTopicIconStickers';
  case ForumUnpin = 'unpinAllForumTopicMessages';
  case InlineQueryAnswer = 'answerInlineQuery';
  case InvoiceCheckoutSend = 'answerPreCheckoutQuery';
  case InvoiceLink = 'createInvoiceLink';
  case InvoiceSend = 'sendInvoice';
  case InvoiceShippingSend = 'answerShippingQuery';
  case MarkupEdit = 'editMessageReplyMarkup';
  case MediaEdit = 'editMessageMedia';
  case MessageCopy = 'copyMessage';
  case MessageDelete = 'deleteMessage';
  case MessageForward = 'forwardMessage';
  case MessagePin = 'pinChatMessage';
  case MessageUnpin = 'unpinChatMessage';
  case MessageUnpinAll = 'unpinAllChatMessages';
  case MyDefaultPermAdmGet = 'getMyDefaultAdministratorRights';
  case MyDefaultPermAdmSet = 'setMyDefaultAdministratorRights';
  case MyGet = 'getMe';
  case NameGet = 'getMyName';
  case NameSet = 'setMyName';
  case PhotoSend = 'sendPhoto';
  case StickerSend = 'sendSticker';
  case TextEdit = 'editMessageText';
  case TextSend = 'sendMessage';
  case UserPhotos = 'getUserProfilePhotos';
  case VideoSend = 'sendVideo';
  case VideoNoteSend = 'sendVideoNote';
  case WebhookSet = 'setWebhook';
  case WebhookGet = 'getWebhookInfo';
  case WebhookDel = 'deleteWebhook';
}