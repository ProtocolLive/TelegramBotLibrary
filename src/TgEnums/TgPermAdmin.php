<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgEnums;

/**
 * @link https://core.telegram.org/bots/api#chatmemberadministrator
 * @version 2025.07.02.00
 */
enum TgPermAdmin:string{
  /**
   * If the administrator can delete messages of other users
   */
  case Delete = 'can_delete_messages';
  /**
   * If the administrator can edit messages of other users and can pin messages; for channels only
   */
  case Edit = 'can_edit_messages';
  /**
   * If the user is allowed to change the chat title, photo and other settings
   */
  case Info = 'can_change_info';
  /**
   * If the user is allowed to invite new users to the chat
   */
  case Invite = 'can_invite_users';
  /**
   * If the administrator can access the chat event log, get boost list, see hidden supergroup and channel members, report spam messages and ignore slow mode. Implied by any other administrator privilege.
   */
  case Manage = 'can_manage_chat';
  /**
   * If the administrator can post messages in the channel, or access channel statistics; for channels only
   */
  case Message = 'can_post_messages';
  /**
   * If the user is allowed to pin messages; for groups and supergroups only
   */
  case Pin = 'can_pin_messages';
  /**
   * If the administrator can add new administrators with a subset of their own privileges or demote administrators that they have promoted, directly or indirectly (promoted by administrators that were appointed by the user)
   */
  case Promote = 'can_promote_members';
  /**
   * If the administrator can restrict, ban or unban chat members, or access supergroup statistics
   */
  case Restrict = 'can_restrict_members';
  /**
   * If the administrator can post stories to the chat
   */
  case StoryCreate = 'can_post_stories';
  /**
   * If the administrator can delete stories posted by other users
   */
  case StoryDelete = 'can_delete_stories';
  /**
   * If the administrator can edit stories posted by other users, post stories to the chat page, pin chat stories, and access the chat's story archive
   */
  case StoryEdit = 'can_edit_stories';
  /**
   * If the user is allowed to create, rename, close, and reopen forum topics; for supergroups only
   */
  case Topics = 'can_manage_topics';
  /**
   * If the administrator can manage video chats
   */
  case Video = 'can_manage_video_chats';
}