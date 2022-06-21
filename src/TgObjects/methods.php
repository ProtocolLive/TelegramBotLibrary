<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.06.21.00
//API 6.1

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
  case FileGet = 'getFile';
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