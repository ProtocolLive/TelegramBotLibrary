<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.12.30.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

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
  case CommandsDel = 'deleteMyCommands';
  case CommandsGet = 'getMyCommands';
  case CommandsSet = 'setMyCommands';
  case CustomEmojiGet = 'getCustomEmojiStickers';
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
  case MessageCopy = 'copyMessage';
  case MessageForward = 'forwardMessage';
  case MyDefaultPermAdmGet = 'getMyDefaultAdministratorRights';
  case MyDefaultPermAdmSet = 'setMyDefaultAdministratorRights';
  case MyGet = 'getMe';
  case PhotoSend = 'sendPhoto';
  case TextEdit = 'editMessageText';
  case TextSend = 'sendMessage';
  case UserPhotos = 'getUserProfilePhotos';
  case WebhookSet = 'setWebhook';
  case WebhookGet = 'getWebhookInfo';
  case WebhookDel = 'deleteWebhook';
}