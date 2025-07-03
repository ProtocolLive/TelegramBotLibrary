<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgEnums;

/**
 * @link https://core.telegram.org/bots/api#chatmemberrestricted
 * @version 2025.07.02.00
 */
enum TgPermMember:string{
  /**
   * If the user is allowed to send audios
   */
  case Audio = 'can_send_audios';
  /**
   * If the user is allowed to send documents
   */
  case Documents = 'can_send_documents';
  /**
   * If the user is allowed to change the chat title, photo and other settings
   */
  case Info = 'can_change_info';
  /**
   * If the user is allowed to invite new users to the chat
   */
  case Invite = 'can_invite_users';
  /**
   * If the user is allowed to send animations, games, stickers and use inline bots
   */
  case Media = 'can_send_other_messages';
  /**
   * If the user is allowed to send text messages, contacts, giveaways, giveaway winners, invoices, locations and venues
   */
  case Message = 'can_send_messages';
  /**
   * If the user is allowed to send photos
   */
  case Photos = 'can_send_photos';
  /**
   * If the user is allowed to pin messages
   */
  case Pin = 'can_pin_messages';
  /**
   * If the user is allowed to send polls
   */
  case Poll = 'can_send_polls';
  /**
   * If the user is allowed to add web page previews to their messages
   */
  case Preview = 'can_add_web_page_previews';
  /**
   * If the user is allowed to create forum topics
   */
  case Topics = 'can_manage_topics';
  /**
   * If the user is allowed to send video notes
   */
  case VideoNote = 'can_send_video_notes';
  /**
   * If the user is allowed to send videos
   */
  case Videos = 'can_send_videos';
  /**
   * If the user is allowed to send voice notes
   */
  case VoiceNote = 'can_send_voice_notes';
}