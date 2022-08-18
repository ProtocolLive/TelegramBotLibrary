<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

enum TgCmdScope:string{
  /**
   * Represents the default scope of bot commands. Default commands are used if no commands with a narrower scope are specified for the user.
   * @link https://core.telegram.org/bots/api#botcommandscopedefault
   */
  case Default = 'default';
  /**
   * Represents the scope of bot commands, covering all private chats.
   * @link https://core.telegram.org/bots/api#botcommandscopeallprivatechats
   */
  case Users = 'all_private_chats';
  /**
   * Represents the scope of bot commands, covering all group and supergroup chats.
   * @link https://core.telegram.org/bots/api#botcommandscopeallgroupchats
   */
  case Groups = 'all_group_chats';
  /**
   * Represents the scope of bot commands, covering a specific chat.
   * @link https://core.telegram.org/bots/api#botcommandscopechat
   */
  case Chat = 'chat';
  /**
   * Represents the scope of bot commands, covering all group and supergroup chat administrators.
   * @link https://core.telegram.org/bots/api#botcommandscopeallchatadministrators
   */
  case GroupsAdmins = 'all_chat_administrators';
  /**
   * Represents the scope of bot commands, covering all administrators of a specific group or supergroup chat.
   * @link https://core.telegram.org/bots/api#botcommandscopechatadministrators
   */
  case GroupAdmins = 'chat_administrators';
  /**
   * Represents the scope of bot commands, covering a specific member of a group or supergroup chat.
   * @link https://core.telegram.org/bots/api#botcommandscopechatmember
   */
  case Member = 'chat_member';
}