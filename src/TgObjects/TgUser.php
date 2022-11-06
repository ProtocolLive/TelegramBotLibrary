<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.11.05.01

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#user
 */
class TgUser{
  /**
   * Unique identifier for this user or bot. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
   */
  public readonly int $Id;
  /**
   * User's or bot's first name
   */
  public readonly string $Name;
  /**
   * If this user is a bot
   */
  public readonly bool $Bot;
  /**
   * If this user added the bot to the attachment menu
   */
  public readonly bool $Attached;
  /**
   * If this user is a Telegram Premium user. This property only comes in message event
   */
  public readonly bool|null $Premium;
  /**
   * User's or bot's last name
   */
  public readonly string|null $NameLast;
  /**
   * User's or bot's username
   */
  public readonly string|null $Nick;
  /**
   * IETF language tag of the user's language
   */
  public readonly string|null $Language;
  /**
   * Custom emoji identifier of emoji status of the other party in a private chat. Returned only in getChat.
   */
  public readonly string|null $Status;
  /**
   * Bio of the other party in a private chat. Returned only in getChat.
   */
  public readonly string|null $Bio;
  /**
   * If privacy settings of the other party in the private chat allows to use tg://user?id=<user_id> links only in chats with the user.
   */
  public readonly bool|null $RestrictedForward;
  /**
   * If the privacy settings of the other party restrict sending voice and video note messages in the private chat. Returned only in getChat.
   */
  public readonly bool|null $RestrictedVoice;
  /**
   * Chat photo. Returned only in getChat.
   */
  public readonly TgChatPhoto|null $Photo;

  /**
   * @link https://core.telegram.org/bots/api#user
   */
  public function __construct(array $Data){
    $this->Id = $Data['id'];
    $this->Name = $Data['first_name'];
    $this->Bot = $Data['is_bot'] ?? false;
    $this->Attached = $Data['added_to_attachment_menu'] ?? false;
    $this->NameLast = $Data['last_name'] ?? null;
    $this->Nick = $Data['username'] ?? null;
    $this->Language = $Data['language_code'] ?? null;
    $this->Status = $Data['emoji_status_custom_emoji_id'] ?? null;
    $this->Bio = $Data['bio'] ?? null;
    $this->RestrictedForward = $Data['has_private_forwards'] ?? false;
    $this->RestrictedVoice = $Data['has_restricted_voice_and_video_messages'] ?? false;
    if(isset($Data['is_premium'])):
      $this->Premium = $Data['is_premium'];
    else:
      $this->Premium = null;
    endif;
    if(isset($Data['photo'])):
      $this->Photo = new TgChatPhoto($Data['photo']);
    endif;
  }
}