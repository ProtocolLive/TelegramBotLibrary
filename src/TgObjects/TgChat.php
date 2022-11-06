<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.11.05.04

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TblBasics;

/**
 * @link https://core.telegram.org/bots/api#chat
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
  public readonly TgPermAdmin $Permissions;
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
  public readonly int|null $SlowMode;
  /**
   * Unique identifier for the linked chat, i.e. the discussion group identifier for a channel and vice versa; for supergroups and channel chats. This identifier may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier. Returned only in getChat.
   */
  public readonly int|null $LinkedChat;
  /**
   * The most recent pinned message (by sending date). Returned only in getChat.
   */
  public readonly array|null $Pinned;

  public function __construct(array $Data){
    $this->Id = $Data['id'];
    $this->Name = $Data['title'];
    $this->Type = TgChatType::from($Data['type']);
    $this->NameLast = $Data['last_name'] ?? null;
    $this->Nick = $Data['username'] ?? null;
    $this->Forum = $Data['is_forum'] ?? false;
    $this->Bio = $Data['description'] ?? false;
    $this->JoinToSend = $Data['join_to_send_messages'] ?? false;
    $this->JoinByRequest = $Data['join_by_request'] ?? false;
    $this->SlowMode = $Data['slow_mode_delay'] ?? null;
    $this->LinkedChat = $Data['linked_chat_id'] ?? null;
    if(isset($Data['permissions'])):
      $this->Permissions = new TgPermAdmin($Data['permissions']);
    endif;
    if(isset($Data['active_usernames'])):
      $this->Nicks = json_decode($Data['active_usernames'], true);
    else:
      $this->Nicks = null;
    endif;
    if(isset($Data['photo'])):
      $this->Photo = new TgChatPhoto($Data['photo']);
    else:
      $this->Photo = null;
    endif;
  }
}