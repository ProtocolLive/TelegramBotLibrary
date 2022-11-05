<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.11.05.01

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

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
   * Last name of the other party in a private chat
   */
  public readonly string|null $NameLast;
  /**
   * Username, for private chats, supergroups and channels if available
   */
  public readonly string|null $Nick;
  /**
   * If the privacy settings of the other party restrict sending voice and video note messages in the private chat. Returned only in getChat.
   */
  public readonly bool|null $RestrictedVoice;
  /**
   * If privacy settings of the other party in the private chat allows to use tg://user?id=<user_id> links only in chats with the user.
   */
  public readonly bool|null $RestrictedForward;

  public readonly TgChatPhoto|null $Photo;
  /**
   * If the supergroup chat is a forum (has topics enabled)
   */
  public readonly bool $Forum;
  /**
   * If non-empty, the list of all active chat usernames; for private chats, supergroups and channels. Returned only in getChat.
   */
  public readonly array|null $Nicks;

  public function __construct(array $Data){
    $this->Id = $Data['id'];
    $this->Name = $Data['title'] ?? $Data['first_name'];
    $this->Type = TgChatType::from($Data['type']);
    $this->NameLast = $Data['last_name'] ?? null;
    $this->Nick = $Data['username'] ?? null;
    $this->RestrictedVoice = $Data['has_restricted_voice_and_video_messages'] ?? false;
    $this->RestrictedForward = $Data['has_private_forwards'] ?? false;
    $this->Forum = $Data['is_forum'] ?? false;
    if(isset($Data['active_usernames'])):
      $this->Nicks = null;
    else:
      $this->Nicks = json_decode($Data['active_usernames'], true);
    endif;
    if(isset($Data['photo'])):
      $this->Photo = new TgChatPhoto($Data['photo']);
    else:
      $this->Photo = null;
    endif;
  }
}