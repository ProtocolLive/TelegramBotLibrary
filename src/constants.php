<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.04.16.00

enum TblError{
  case Custom;
  case NoSsl;
  case NoCurl;
  case Curl;
  case LimitCallbackData;
  case LimitPhotoCaption;
  case LimitCommand;
  case LimitCmdDescription;
  case NoEvent;
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
  const Webhook = 3;
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
  case Message = 'message';
  case MessageEdit = 'edited_message';
  case ChannelPost = 'channel_post';
  case ChannelPostEdit = 'edited_channel_post';
  case InlineQuery = 'inline_query';
  case InlineQueryChosen = 'chosen_inline_result';
  case Callback = 'callback_query';
  case CheckoutPre = 'pre_checkout_query';
  case Poll = 'poll';
  case PollAnswer = 'poll_answer';
  case ChatMe = 'my_chat_member';
  case Chat = 'chat_member';
  case ChatJoinRequest = 'chat_join_request';
}

enum DefaultPerms{
  case Groups;
  case Channels;
}