<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblBasics;

/**
 * @link https://core.telegram.org/bots/api#chat
 * @version 2023.12.29.00
 * 
 */
class TgChat{
  /**
   * Unique identifier for this chat. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
   */
  public readonly int $Id;
  /**
   * First name of the other party in a private chat or title, for supergroups, channels and group chats
   */
  public readonly string $Name;
  /**
   * Type of chat, can be either “private”, “group”, “supergroup” or “channel”
   */
  public readonly TgChatType $Type;
  /**
   * Username, for private chats, supergroups and channels if available
   */
  public readonly string|null $Nick;
  /**
   * Description, for groups, supergroups and channel chats. Returned only in getChat.
   */
  public readonly string|null $Bio;
  /**
   * Chat photo. Returned only in getChat.
   */
  public readonly TgChatPhoto|null $Photo;
  /**
   * If the supergroup chat is a forum (has topics enabled)
   */
  public readonly bool $Forum;
  /**
   * If non-empty, the list of all active chat usernames; for private chats, supergroups and channels. Returned only in getChat.
   */
  public readonly array|null $Nicks;
  /**
   * Default chat member permissions, for groups and supergroups. Returned only in getChat.
   */
  public readonly TgPermAdmin|null $Permissions;
  /**
   * If users need to join the supergroup before they can send messages. Returned only in getChat.
   */
  public readonly bool $JoinToSend;
  /**
   * If all users directly joining the supergroup need to be approved by supergroup administrators. Returned only in getChat.
   */
  public readonly bool $JoinByRequest;
  /**
   * For supergroups, the minimum allowed delay between consecutive messages sent by each unpriviledged user; in seconds. Returned only in getChat.
   */
  public readonly int $SlowMode;
  /**
   * Unique identifier for the linked chat, i.e. the discussion group identifier for a channel and vice versa; for supergroups and channel chats. This identifier may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier. Returned only in getChat.
   */
  public readonly int|null $LinkedChat;
  /**
   * The most recent pinned message (by sending date). Returned only in getChat.
   */
  public array|null $Pinned;
  /**
   * If messages from the chat can't be forwarded to other chats. Returned only in getChat.
   */
  public readonly bool $Protected;
  /**
   * If non-administrators can only get the list of bots and administrators in the chat. Returned only in getChat.
   */
  public readonly bool|null $HidedMembers;
  /**
   * If aggressive anti-spam checks are enabled in the supergroup. The field is only available to chat administrators. Returned only in getChat.
   */
  public readonly bool|null $AntiSpam;
  /**
   * Custom emoji identifier of emoji status of the other party in a private chat. Returned only in getChat.
   */
  public readonly string|null $Emoji;
  /**
   * Expiration date of the emoji status of the other party in a private chat, if any. Returned only in getChat.
   */
  public readonly string|null $EmojiExpiration;
  /**
   * List of available reactions allowed in the chat. If omitted, then all emoji reactions are allowed. Returned only in getChat.
   */
  public array|null $Reactions;

  public function __construct(
    array $Data
  ){
    $this->Id = $Data['id'];
    $this->Name = $Data['title'];
    $this->Type = TgChatType::from($Data['type']);
    $this->Nick = $Data['username'] ?? null;
    $this->Forum = $Data['is_forum'] ?? false;
    $this->Bio = $Data['description'] ?? false;
    $this->JoinToSend = $Data['join_to_send_messages'] ?? false;
    $this->JoinByRequest = $Data['join_by_request'] ?? false;
    $this->SlowMode = $Data['slow_mode_delay'] ?? 0;
    $this->LinkedChat = $Data['linked_chat_id'] ?? null;
    $this->Protected = $Data['has_protected_content'] ?? false;
    $this->HidedMembers = $Data['has_hidden_members'] ?? false;
    $this->AntiSpam = $Data['has_aggressive_anti_spam_enabled'] ?? false;
    $this->Nicks = $Data['active_usernames'] ?? null;
    $this->Emoji = $Data['emoji_status_custom_emoji_id'] ?? null;
    $this->EmojiExpiration = $Data['emoji_status_expiration_date'] ?? null;
    if(isset($Data['permissions'])):
      $this->Permissions = new TgPermAdmin($Data['permissions']);
    else:
      $this->Permissions = null;
    endif;
    if(isset($Data['photo'])):
      $this->Photo = new TgChatPhoto($Data['photo']);
    else:
      $this->Photo = null;
    endif;
    if(isset($Data['pinned_message'])):
      $this->Pinned[] = TblBasics::DetectMessage($Data['pinned_message']);
    else:
      $this->Pinned = null;
    endif;
    if(isset($Data['available_reactions'])):
      foreach($Data['available_reactions'] as $reaction):
        $this->Reactions[] = new TgReaction($reaction);
      endforeach;
    else:
      $this->Reactions = null;
    endif;
  }
}