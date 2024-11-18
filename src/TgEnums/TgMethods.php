<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgEnums;

/**
 * @version 2024.11.17.00
 */
enum TgMethods:string{
  /**
   * @link https://core.telegram.org/bots/api#sendanimation
   */
  case AnimationSend = 'sendAnimation';
  /**
   * @link https://core.telegram.org/bots/api#sendaudio
   */
  case AudioSend = 'sendAudio';
  /**
   * @link https://core.telegram.org/bots/api#getbusinessconnection
   */
  case BusinessGet = 'getBusinessConnection';
  /**
   * @link https://core.telegram.org/bots/api#answercallbackquery
   */
  case CallbackAnswer = 'answerCallbackQuery';
  /**
   * @link https://core.telegram.org/bots/api#editmessagecaption
   */
  case CaptionEdit = 'editMessageCaption';
  /**
   * https://core.telegram.org/bots/api#getchat
   */
  case Chat = 'getChat';
  /**
   * @link https://core.telegram.org/bots/api#sendchataction
   */
  case ChatAction = 'sendChatAction';
  /**
   * @link https://core.telegram.org/bots/api#getchatadministrators
   */
  case ChatAdms = 'getChatAdministrators';
  /**
   * @link https://core.telegram.org/bots/api#setchatadministratorcustomtitle
   */
  case ChatAdmTitle = 'setChatAdministratorCustomTitle';
  /**
   * @link https://core.telegram.org/bots/api#banchatsenderchat
   */
  case ChatBanChannel = 'banChatSenderChat';
  /**
   * @link https://core.telegram.org/bots/api#unbanchatsenderchat
   */
  case ChatBanChannelUndo = 'unbanChatSenderChat';
  /**
   * @link https://core.telegram.org/bots/api#getuserchatboosts
   */
  case ChatBoosterGet = 'getUserChatBoosts';
  /**
   * @link https://core.telegram.org/bots/api#setchatdescription
   */
  case ChatDescription = 'setChatDescription';
  /**
   * @link https://core.telegram.org/bots/api#createchatinvitelink
   */
  case ChatInviteLinkCreate = 'createChatInviteLink';
  /**
   * @link https://core.telegram.org/bots/api#revokechatinvitelink
   */
  case ChatInviteLinkDel = 'revokeChatInviteLink';
  /**
   * @link https://core.telegram.org/bots/api#editchatinvitelink
   */
  case ChatInviteLinkEdit = 'editChatInviteLink';
  /**
   * @link https://core.telegram.org/bots/api#exportchatinvitelink
   */
  case ChatInviteExport = 'exportChatInviteLink';
  /**
   * @link https://core.telegram.org/bots/api#approvechatjoinrequest
   */
  case ChatJoinApprove = 'approveChatJoinRequest';
  /**
   * @link https://core.telegram.org/bots/api#declinechatjoinrequest
   */
  case ChatJoinDecline = 'declineChatJoinRequest';
  /**
   * @link https://core.telegram.org/bots/api#leavechat
   */
  case ChatLeave = 'leaveChat';
  /**
   * @link https://core.telegram.org/bots/api#getchatmember
   */
  case ChatMember = 'getChatMember';
  /**
   * @link https://core.telegram.org/bots/api#banchatmember
   */
  case ChatMemberBan = 'banChatMember';
  /**
   * @link https://core.telegram.org/bots/api#unbanchatmember
   */
  case ChatMemberBanUndo = 'unbanChatMember';
  /**
   * @link https://core.telegram.org/bots/api#getchatmembercount
   */
  case ChatMemberCount = 'getChatMemberCount';
  /**
   * @link https://core.telegram.org/bots/api#restrictchatmember
   */
  case ChatMemberPerm = 'restrictChatMember';
  /**
   * @link https://core.telegram.org/bots/api#promotechatmember
   */
  case ChatMemberPromote = 'promoteChatMember';
  /**
   * @link https://core.telegram.org/bots/api#getchatmenubutton
   */
  case ChatMenuButtonGet = 'getChatMenuButton';
  /**
   * @link https://core.telegram.org/bots/api#setchatmenubutton
   */
  case ChatMenuButtonSet = 'setChatMenuButton';
  /**
   * @link https://core.telegram.org/bots/api#setchatpermissions
   */
  case ChatPerm = 'setChatPermissions';
  /**
   * @link https://core.telegram.org/bots/api#deletechatphoto
   */
  case ChatPhotoDel = 'deleteChatPhoto';
  /**
   * @link https://core.telegram.org/bots/api#setchatphoto
   */
  case ChatPhotoSet = 'setChatPhoto';
  /**
   * @link https://core.telegram.org/bots/api#setchattitle
   */
  case ChatTitle = 'setChatTitle';
  /**
   * @link https://core.telegram.org/bots/api#deletemycommands
   */
  case CommandsDel = 'deleteMyCommands';
  /**
   * @link https://core.telegram.org/bots/api#getmycommands
   */
  case CommandsGet = 'getMyCommands';
  /**
   * @link https://core.telegram.org/bots/api#setmycommands
   */
  case CommandsSet = 'setMyCommands';
  /**
   * @link https://core.telegram.org/bots/api#getcustomemojistickers
   */
  case CustomEmojiGet = 'getCustomEmojiStickers';
  /**
   * @link https://core.telegram.org/bots/api#getmydescription
   */
  case DescriptionGet = 'getMyDescription';
  /**
   * @link https://core.telegram.org/bots/api#setmydescription
   */
  case DescriptionSet = 'setMyDescription';
  /**
   * @link https://core.telegram.org/bots/api#getmyshortdescription
   */
  case DescriptionShortGet = 'getMyShortDescription';
  /**
   * @link https://core.telegram.org/bots/api#setmyshortdescription
   */
  case DescriptionShortSet = 'setMyShortDescription';
  /**
   * @link https://core.telegram.org/bots/api#senddice
   */
  case DiceSend = 'sendDice';
  /**
   * @link https://core.telegram.org/bots/api#senddocument
   */
  case DocumentSend = 'sendDocument';
  /**
   * @link https://core.telegram.org/bots/api#getfile
   */
  case FileGet = 'getFile';
  /**
   * @link https://core.telegram.org/bots/api#closeforumtopic
   */
  case ForumClose = 'closeForumTopic';
  /**
   * @link https://core.telegram.org/bots/api#createforumtopic
   */
  case ForumCreate = 'createForumTopic';
  /**
   * @link https://core.telegram.org/bots/api#deleteforumtopic
   */
  case ForumDel = 'deleteForumTopic';
  /**
   * @link https://core.telegram.org/bots/api#editforumtopic
   */
  case ForumEdit = 'editForumTopic';
  /**
   * @link https://core.telegram.org/bots/api#closegeneralforumtopic
   */
  case ForumGeneralClose = 'closeGeneralForumTopic';
  /**
   * @link https://core.telegram.org/bots/api#editgeneralforumtopic
   */
  case ForumGeneralEdit = 'editGeneralForumTopic';
  /**
   * @link https://core.telegram.org/bots/api#hidegeneralforumtopic
   */
  case ForumGeneralHide = 'hideGeneralForumTopic';
  /**
   * @link https://core.telegram.org/bots/api#reopengeneralforumtopic
   */
  case ForumGeneralReopen = 'reopenGeneralForumTopic';
  /**
   * @link https://core.telegram.org/bots/api#unhidegeneralforumtopic
   */
  case ForumGeneralUnhide = 'unhideGeneralForumTopic';
  /**
   * @link https://core.telegram.org/bots/api#reopenforumtopic
   */
  case ForumReopen = 'reopenForumTopic';
  /**
   * @link https://core.telegram.org/bots/api#getforumtopiciconstickers
   */
  case ForumStickers = 'getForumTopicIconStickers';
  /**
   * @link https://core.telegram.org/bots/api#unpinallforumtopicmessages
   */
  case ForumUnpin = 'unpinAllForumTopicMessages';
  /**
   * @link https://core.telegram.org/bots/api#unpinallgeneralforumtopicmessages
   */
  case ForumUnpinAllGeneral = 'unpinAllGeneralForumTopicMessages';
  /**
   * @link https://core.telegram.org/bots/api#getgamehighscores
   */
  case GameScoreGet = 'getGameHighScores';
  /**
   * @link https://core.telegram.org/bots/api#setgamescore
   */
  case GameScoreSet = 'setGameScore';
  /**
   * @link https://core.telegram.org/bots/api#sendgame
   */
  case GameSend = 'sendGame';
  /**
   * @link https://core.telegram.org/bots/api#sendmediagroup
   */
  case GroupSend = 'sendMediaGroup';
  /**
   * @link https://core.telegram.org/bots/api#answerinlinequery
   */
  case InlineQueryAnswer = 'answerInlineQuery';
  /**
   * @link https://core.telegram.org/bots/api#createchatsubscriptioninvitelink
   */
  case InviteLinkStarCreate = 'createChatSubscriptionInviteLink';
  /**
   * @link https://core.telegram.org/bots/api#editchatsubscriptioninvitelink
   */
  case InviteLinkStarEdit = 'editChatSubscriptionInviteLink';
  /**
   * @link https://core.telegram.org/bots/api#answerprecheckoutquery
   */
  case InvoiceCheckoutSend = 'answerPreCheckoutQuery';
  /**
   * @link https://core.telegram.org/bots/api#createinvoicelink
   */
  case InvoiceLink = 'createInvoiceLink';
  /**
   * @link https://core.telegram.org/bots/api#sendinvoice
   */
  case InvoiceSend = 'sendInvoice';
  /**
   * @link https://core.telegram.org/bots/api#answershippingquery
   */
  case InvoiceShippingSend = 'answerShippingQuery';
  /**
   * @link https://core.telegram.org/bots/api#editmessagelivelocation
   */
  case LocationEdit = 'editMessageLiveLocation';
  /**
   * @link https://core.telegram.org/bots/api#sendlocation
   */
  case LocationSend = 'sendLocation';
  /**
   * @link https://core.telegram.org/bots/api#editmessagelivelocation
   */
  case LocationStop = 'stopMessageLiveLocation';
  /**
   * @link https://core.telegram.org/bots/api#editmessagereplymarkup
   */
  case MarkupEdit = 'editMessageReplyMarkup';
  /**
   * @link https://core.telegram.org/bots/api#editmessagemedia
   */
  case MediaEdit = 'editMessageMedia';
  /**
   * @link https://core.telegram.org/bots/api#copymessage
   */
  case MessageCopy = 'copyMessage';
  /**
   * @link https://core.telegram.org/bots/api#deletemessage
   */
  case MessageDelete = 'deleteMessage';
  /**
   * @link https://core.telegram.org/bots/api#forwardmessage
   */
  case MessageForward = 'forwardMessage';
  /**
   * @link https://core.telegram.org/bots/api#pinchatmessage
   */
  case MessagePin = 'pinChatMessage';
  /**
   * @link https://core.telegram.org/bots/api#setmessagereaction
   */
  case MessageReaction = 'setMessageReaction';
  /**
   * @link https://core.telegram.org/bots/api#copymessages
   */
  case MessagesCopy = 'copyMessages';
  /**
   * @link https://core.telegram.org/bots/api#deletemessages
   */
  case MessagesDelete = 'deleteMessages';
  /**
   * @link https://core.telegram.org/bots/api#forwardmessages
   */
  case MessagesForward = 'forwardMessages';
  /**
   * @link https://core.telegram.org/bots/api#unpinchatmessage
   */
  case MessageUnpin = 'unpinChatMessage';
  /**
   * @link https://core.telegram.org/bots/api#unpinallchatmessages
   */
  case MessageUnpinAll = 'unpinAllChatMessages';
  /**
   * @link https://core.telegram.org/bots/api#getmydefaultadministratorrights
   */
  case MyDefaultPermAdmGet = 'getMyDefaultAdministratorRights';
  /**
   * @link https://core.telegram.org/bots/api#setmydefaultadministratorrights
   */
  case MyDefaultPermAdmSet = 'setMyDefaultAdministratorRights';
  /**
   * @link https://core.telegram.org/bots/api#getme
   */
  case MyGet = 'getMe';
  /**
   * @link https://core.telegram.org/bots/api#getmyname
   */
  case NameGet = 'getMyName';
  /**
   * @link https://core.telegram.org/bots/api#setmyname
   */
  case NameSet = 'setMyName';
  /**
   * @link https://core.telegram.org/bots/api#sendpaidmedia
   */
  case PaidMediaSend = 'sendPaidMedia';
  /**
   * @link https://core.telegram.org/bots/api#getmyphoto
   */
  case PhotoSend = 'sendPhoto';
  /**
   * @link https://core.telegram.org/bots/api#sendpoll
   */
  case PollSend = 'sendPoll';
  /**
   * @link https://core.telegram.org/bots/api#stoppoll
   */
  case PollStop = 'stopPoll';
  /**
   * @link https://core.telegram.org/bots/api#refundstarpayment
   */
  case StarRefund = 'refundStarPayment';
  /**
   * @link https://core.telegram.org/bots/api#edituserstarsubscription
   */
  case StarSubscriptionEdit = 'editUserStarSubscription';
  /**
   * @link https://core.telegram.org/bots/api#getstartransactions
   */
  case StarTransactionsGet = 'getStarTransactions';
  /**
   * @link https://core.telegram.org/bots/api#sendsticker
   */
  case StickerSend = 'sendSticker';
  /**
   * @link https://core.telegram.org/bots/api#editmessagetext
   */
  case TextEdit = 'editMessageText';
  /**
   * @link https://core.telegram.org/bots/api#sendmessage
   */
  case TextSend = 'sendMessage';
  /**
   * @link https://core.telegram.org/bots/api#getuserprofilephotos
   */
  case UserPhotos = 'getUserProfilePhotos';
  /**
   * @link https://core.telegram.org/bots/api#sendvenue
   */
  case VenueSend = 'sendVenue';
  /**
   * @link https://core.telegram.org/bots/api#sendvideo
   */
  case VideoSend = 'sendVideo';
  /**
   * @link https://core.telegram.org/bots/api#sendvideonote
   */
  case VideoNoteSend = 'sendVideoNote';
  /**
   * @link https://core.telegram.org/bots/api#sendvoice
   */
  case VoiceSend = 'sendVoice';
  /**
   * @link https://core.telegram.org/bots/api#setwebhook
   */
  case WebhookSet = 'setWebhook';
  /**
   * @link https://core.telegram.org/bots/api#getwebhookinfo
   */
  case WebhookGet = 'getWebhookInfo';
  /**
   * @link https://core.telegram.org/bots/api#deletewebhook
   */
  case WebhookDel = 'deleteWebhook';
}