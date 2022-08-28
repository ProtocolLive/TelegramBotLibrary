<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.19.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

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