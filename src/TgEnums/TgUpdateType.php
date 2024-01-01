<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgEnums;

/**
 * https://core.telegram.org/bots/api#update
 * @version 2024.01.01.00
 */
enum TgUpdateType:string{
  case Callback = 'callback_query';
  case ChannelPost = 'channel_post';
  case ChannelPostEdit = 'edited_channel_post';
  case ChatMy = 'my_chat_member';
  case Chat = 'chat_member';
  case ChatBoost = 'chat_boost';
  case ChatBoostRemoved = 'removed_chat_boost';
  case ChatJoinRequest = 'chat_join_request';
  case InlineQuery = 'inline_query';
  case InlineQueryChosen = 'chosen_inline_result';
  case InvoiceShipping = 'shipping_query';
  case InvoiceCheckout = 'pre_checkout_query';
  case Message = 'message';
  case MessageReaction = 'message_reaction';
  case MessageReactionCount = 'message_reaction_count';
  case MessageEdit = 'edited_message';
  case Poll = 'poll';
  case PollAnswer = 'poll_answer';
}