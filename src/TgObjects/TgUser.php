<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#user
 * @version 2024.01.04.01
 */
final readonly class TgUser{
  /**
   * Unique identifier for this user or bot. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
   */
  public int $Id;
  /**
   * User's or bot's first name
   */
  public string $Name;
  /**
   * If this user added the bot to the attachment menu
   */
  public bool $Attached;
  /**
   * If this user is a Telegram Premium user. This property only comes in message event
   */
  public bool|null $Premium;
  /**
   * User's or bot's last name
   */
  public string|null $NameLast;
  /**
   * User's or bot's username
   */
  public string|null $Nick;
  public array|null $Nicks;
  /**
   * IETF language tag of the user's language
   */
  public string|null $Language;
  /**
   * Custom emoji identifier of emoji status of the other party in a private chat. Returned only in getChat.
   */
  public string|null $Status;
  /**
   * Bio of the other party in a private chat. Returned only in getChat.
   */
  public string|null $Bio;
  /**
   * If privacy settings of the other party in the private chat allows to use tg://user?id=<user_id> links only in chats with the user.
   */
  public bool|null $RestrictedForward;
  /**
   * If the privacy settings of the other party restrict sending voice and video note messages in the private chat. Returned only in getChat.
   */
  public bool|null $RestrictedVoice;
  /**
   * Chat photo. Returned only in getChat.
   */
  public TgChatPhoto|null $Photo;
  /**
   * The time after which all messages sent to the chat will be automatically deleted; in seconds. Returned only in getChat.
   */
  public int $AutoDel;

  /**
   * @link https://core.telegram.org/bots/api#user
   */
  public function __construct(
    array $Data
  ){
    $this->Id = $Data['id'];
    $this->Name = $Data['first_name'];
    $this->Attached = $Data['added_to_attachment_menu'] ?? false;
    $this->NameLast = $Data['last_name'] ?? null;
    $this->Nick = $Data['username'] ?? null;
    $this->Language = $Data['language_code'] ?? null;
    $this->Status = $Data['emoji_status_custom_emoji_id'] ?? null;
    $this->Bio = $Data['bio'] ?? null;
    $this->RestrictedForward = $Data['has_private_forwards'] ?? null;
    $this->RestrictedVoice = $Data['has_restricted_voice_and_video_messages'] ?? null;
    $this->Premium = $Data['is_premium'] ?? null;
    $this->Nicks = $Data['active_usernames'] ?? null;
    $this->AutoDel = $Data['message_auto_delete_time'] ?? 0;
    if(isset($Data['photo'])):
      $this->Photo = new TgChatPhoto($Data['photo']);
    else:
      $this->Photo = null;
    endif;
  }
}