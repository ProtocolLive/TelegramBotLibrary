<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgEnums;

/**
 * @version 2024.04.30.00
 */
enum TgMethods:string{
  case AnimationSend = 'sendAnimation';
  /**
   * @link https://core.telegram.org/bots/api#sendaudio
   */
  case AudioSend = 'sendAudio';
  /**
   * @link https://core.telegram.org/bots/api#getbusinessconnection
   */
  case BusinessGet = 'getBusinessConnection';
  case CallbackAnswer = 'answerCallbackQuery';
  case Chat = 'getChat';
  case ChatAction = 'sendChatAction';
  case ChatAdms = 'getChatAdministrators';
  case ChatAdmTitle = 'setChatAdministratorCustomTitle';
  case ChatBanChannel = 'banChatSenderChat';
  case ChatBanChannelUndo = 'unbanChatSenderChat';
  case ChatBoosterGet = 'getUserChatBoosts';
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
  /**
   * @link https://core.telegram.org/bots/api#senddice
   */
  case DiceSend = 'sendDice';
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
  case ForumUnpinAllGeneral = 'unpinAllGeneralForumTopicMessages';
  case GameScoreGet = 'getGameHighScores';
  case GameScoreSet = 'setGameScore';
  case GameSend = 'sendGame';
  /**
   * @link https://core.telegram.org/bots/api#sendmediagroup
   */
  case GroupSend = 'sendMediaGroup';
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
  case MessageReaction = 'setMessageReaction';
  case MessagesCopy = 'copyMessages';
  case MessagesDelete = 'deleteMessages';
  case MessagesForward = 'forwardMessages';
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
  /**
   * @link https://core.telegram.org/bots/api#sendvoice
   */
  case VoiceSend = 'sendVoice';
  case WebhookSet = 'setWebhook';
  case WebhookGet = 'getWebhookInfo';
  case WebhookDel = 'deleteWebhook';
}