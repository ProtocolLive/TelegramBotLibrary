<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.04.22.01

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
  case EditMarkup = 'editMessageReplyMarkup';
  case EditText = 'editMessageText';
  case FileGet = 'getFile';
  case InlineQueryAnswer = 'answerInlineQuery';
  case MessageCopy = 'copyMessage';
  case MessageForward = 'forwardMessage';
  case MyDefaultPermAdmGet = 'getMyDefaultAdministratorRights';
  case MyDefaultPermAdmSet = 'setMyDefaultAdministratorRights';
  case MyGet = 'getMe';
  case SendCheckout = 'answerPreCheckoutQuery';
  case SendInvoice = 'sendInvoice';
  case SendPhoto = 'sendPhoto';
  case SendShipping = 'answerShippingQuery';
  case SendText = 'sendMessage';
  case UserPhotos = 'getUserProfilePhotos';
  case WebhookSet = 'setWebhook';
  case WebhookGet = 'getWebhookInfo';
  case WebhookDel = 'deleteWebhook';
}