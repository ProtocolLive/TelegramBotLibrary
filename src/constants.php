<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.06.21.02
//API 6.1

enum TblError{
  case Curl;
  case Custom;
  case InvoicePriceEmpty;
  case InvoicePriceHigh;
  case InvoicePriceLow;
  case LimitCallbackData;
  case LimitCmdDescription;
  case LimitCommand;
  case LimitPhotoCaption;
  case NoCurl;
  case NoEvent;
  case NoSsl;
  case TokenWebhook;
}

enum TblLog{
  case Error;
  case Webhook;
  case Send;
  case Response;
}

//Debug are int to use binary operators
class TblDebug{
  const All = -1;
  const None = 0;
  const Send = 1;
  const Response = 2;
  const Webhook = 4;
  const Curl = 8;
}

class TgLimits{
  const CallbackAnswer = 200;
  const CallbackData = 64;
  const Caption = 1024;
  const Command = 32;
  const CmdDescription = 256;
  const MediaGroup = 10;
  const Text = 4096;
}

/**
 * https://core.telegram.org/bots/api#update
 */
enum TgUpdateType:string{
  case Callback = 'callback_query';
  case ChannelPost = 'channel_post';
  case ChannelPostEdit = 'edited_channel_post';
  case ChatMy = 'my_chat_member';
  case Chat = 'chat_member';
  case ChatJoinRequest = 'chat_join_request';
  case InlineQuery = 'inline_query';
  case InlineQueryChosen = 'chosen_inline_result';
  case InvoiceShipping = 'shipping_query';
  case InvoiceCheckout = 'pre_checkout_query';
  case Message = 'message';
  case MessageEdit = 'edited_message';
  case Poll = 'poll';
  case PollAnswer = 'poll_answer';
}

enum DefaultPerms{
  case Groups;
  case Channels;
}