<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#user
 * @version 2024.03.31.01
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
   * The time after which all messages sent to the chat will be automatically deleted; in seconds. Returned only in getChat.
   */
  public int $AutoDel;
  /**
   * Chat photo. Returned only in getChat.
   */
  public TgChatPhoto|null $Photo;
  /**
   * For private chats with business accounts, the intro of the business. Returned only in getChat.
   */
  public TgBusinessIntro|null $BusinessIntro;
  /**
   * For private chats with business accounts, the location of the business. Returned only in getChat.
   */
  public TgBusinessLocation|null $BusinessLocation;
  /**
   * For private chats with business accounts, the opening hours of the business. Returned only in getChat.
   */
  public TgBusinessOpen|null $BusinessOpen;
  /**
   * For private chats, the personal channel of the user. Returned only in getChat.
   */
  public TgChat|null $Channel;
  /**
   * For private chats, the date of birth of the user. Returned only in getChat.
   */
  public string $Birthdate;

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
    if(isset($Data['business_info'])):
      $this->BusinessIntro = new TgBusinessIntro($Data['business_intro']);
    else:
      $this->BusinessIntro = null;
    endif;
    if(isset($Data['business_location'])):
      $this->BusinessLocation = new TgBusinessLocation($Data['business_location']);
    else:
      $this->BusinessLocation = null;
    endif;
    if(isset($Data['business_opening_hours'])):
      $this->BusinessOpen = new TgBusinessOpen($Data['business_opening_hours']);
    else:
      $this->BusinessOpen = null;
    endif;
    if(isset($Data['personal_chat'])):
      $this->Channel = new TgChat($Data['personal_chat']);
    else:
      $this->Channel = null;
    endif;
    if(isset($Data['birthdate'])):
      if(isset($Data['birthdate']['year'])):
        $Birthdate = $Data['birthdate']['year'] . '-';
      endif;
      $Birthdate .= $Data['birthdate']['month'] . '-' . $Data['birthdate']['day'];
    else:
      $this->Birthdate = null;
    endif;
  }
}