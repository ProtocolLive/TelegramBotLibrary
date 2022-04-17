<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.04.17.00
//API 6.0

enum TgChatType:string{
  case Private = 'private';
  case Group = 'group';
  case GroupSuper = 'supergroup';
  case Channel = 'channel';
  case InlineQuery = 'sender';
}

/**
 * @link https://core.telegram.org/bots/api#chat
 */
class TgChat{
  public readonly int $Id;
  public readonly string $Name;
  public readonly TgChatType $Type;
  public readonly string|null $NameLast;
  public readonly string|null $Nick;

  public function __construct(array $Data){
    $this->Id = $Data['id'];
    $this->Name = $Data['title'] ?? $Data['first_name'];
    $this->Type = TgChatType::tryFrom($Data['type']);
    $this->NameLast = $Data['last_name'] ?? null;
    $this->Nick = $Data['username'] ?? null;
  }
}

/**
 * @link https://core.telegram.org/bots/api#chatmember
 */
class TgMember{
  public readonly TgUser $Member;
  public readonly bool $In;
  public readonly TgMemberStatus $Status;
  public readonly TgPermAdmin $AdminPerms;
  public readonly TgPermMember $MemberPerms;
  public readonly bool $Anonymous;
  public readonly string|null $Title;
  public readonly int|null $Expires;

  public function __construct(array $Data){
    $this->Member = new TgUser($Data['user']);
    $this->Status = TgMemberStatus::tryFrom($Data['status']);
    if($this->Status === TgMemberStatus::Restricted):
      $this->In = $Data['is_member'];
    elseif($this->Status === TgMemberStatus::Member
    or $this->Status === TgMemberStatus::Creator
    or $this->Status === TgMemberStatus::Adm):
      $this->In = true;
    elseif($this->Status === TgMemberStatus::Left
    or $this->Status === TgMemberStatus::Banned):
      $this->In = false;
    endif;
    $this->Anonymous = $Data['is_anonymous'] ?? false;
    $this->Title = $Data['custom_title'] ?? null;
    $this->Expires = $Data['until_date'] ?? null;
    if($this->Status === TgMemberStatus::Creator):
      $this->AdminPerms = new TgPermAdmin(null, true, false, true, true, true, true, true);
      $this->MemberPerms = new TgPermMember(null, true, true, true,true, true, true, true, true);
    else:
      $this->AdminPerms = new TgPermAdmin($Data);
      $this->MemberPerms = new TgPermMember($Data);
    endif;
  }
}

enum TgMemberStatus:string{
  /**
   * Represents a chat member that owns the chat and has all administrator privileges.
   * @link https://core.telegram.org/bots/api#chatmemberowner
   */
  case Creator = 'creator';
  /**
   * Represents a chat member that has some additional privileges.
   * @link https://core.telegram.org/bots/api#chatmemberadministrator
   */
  case Adm = 'administrator';
  /**
   * Represents a chat member that has no additional privileges or restrictions.
   * @link https://core.telegram.org/bots/api#chatmembermember
   */
  case Member = 'member';
  /**
   * Represents a chat member that is under certain restrictions in the chat. Supergroups only.
   * @link https://core.telegram.org/bots/api#chatmemberrestricted
   */
  case Restricted = 'restricted';
  /**
   * Represents a chat member that isn't currently a member of the chat, but may join it themselves.
   * @link https://core.telegram.org/bots/api#chatmemberleft
   */
  case Left = 'left';
  /**
   * Represents a chat member that was banned in the chat and can't return to the chat or view chat messages.
   * @link https://core.telegram.org/bots/api#chatmemberbanned
   */
  case Banned = 'kicked';
}

/**
 * @link https://core.telegram.org/bots/api#chatmemberadministrator
 */
class TgPermAdmin{
  const Array = [
    'Manage' => 'can_manage_chat',
    'Message' => 'can_post_messages',
    'Edit' => 'can_edit_messages',
    'Delete' => 'can_delete_messages',
    'Invite' => 'can_invite_users',
    'Restrict' => 'can_restrict_members',
    'Promote' => 'can_promote_members',
    'Video' => 'can_manage_video_chats',
    'Info' => 'can_change_info',
    'Pin' => 'can_pin_messages'
  ];

  /**
   * @param bool $Manage If the administrator can access the chat event log, chat statistics, message statistics in channels, see channel members, see anonymous administrators in supergroups and ignore slow mode. Implied by any other administrator privilege
   * @param bool $Message If the administrator can post in the channel; channels only
   * @param bool $Edited If the bot is allowed to edit administrator privileges of that user
   * @param bool $Edit If the administrator can edit messages of other users and can pin messages; channels only
   * @param bool $Delete If the administrator can delete messages of other users
   * @param bool $Invite If the user is allowed to invite new users to the chat
   * @param bool $Restrict If the administrator can restrict, ban or unban chat members
   * @param bool $Promote If the administrator can add new administrators with a subset of their own privileges or demote administrators that he has promoted, directly or indirectly (promoted by administrators that were appointed by the user)
   * @param bool $Video If the administrator can manage video chats
   * @param bool $Info If the administrator can change chat title, photo and other settings
   * @param bool $Pin If the administrator can pin messages, supergroups only
   * @link https://core.telegram.org/bots/api#chatmemberadministrator
   */
  public function __construct(
    array $Data = null,
    public bool $Manage = false,
    public bool $Message = false,
    public bool $Edited = true,
    public bool $Edit = false,
    public bool $Delete = false,
    public bool $Invite = false,
    public bool $Restrict = false,
    public bool $Promote = false,
    public bool $Video = false,
    public bool $Info = false,
    public bool $Pin = false
  ){
    if($Data !== null):
      foreach(self::Array as $perm => $vector):
        $this->$perm = $Data[$vector] ?? false;
      endforeach;
    endif;
  }
}

/**
 * @link https://core.telegram.org/bots/api#chatpermissions
 */
class TgPermMember{
  const Array = [
    'Message' => 'can_send_messages',
    'Media' => 'can_send_media_messages',
    'Poll' => 'can_send_polls',
    'Media2' => 'can_send_other_messages',
    'Preview' => 'can_add_web_page_previews',
    'Info' => 'can_change_info',
    'Invite' => 'can_invite_users',
    'Pin' => 'can_pin_messages'
  ];

  /**
   * Describes actions that a non-administrator user is allowed to take in a chat.
   * @param bool $Message If the user is allowed to send text messages, contacts, locations and venues
   * @param bool $Media If the user is allowed to send audios, documents, photos, videos, video notes and voice notes, implies can_send_messages
   * @param bool $Poll If the user is allowed to send polls, implies can_send_messages
   * @param bool $Media2 If the user is allowed to send animations, games, stickers and use inline bots, implies $Media
   * @param bool $Preview If the user is allowed to add web page previews to their messages, implies $Media
   * @param bool $Info If the user is allowed to change the chat title, photo and other settings. Ignored in public supergroups
   * @param bool $Invite If the user is allowed to invite new users to the chat
   * @param bool $Pin If the user is allowed to pin messages. Ignored in public supergroups
   * @link https://core.telegram.org/bots/api#chatpermissions
   */
  public function __construct(
    array $Data = null,
    public bool $Message = false,
    public bool $Media = false,
    public bool $Poll = false,
    public bool $Media2 = false,
    public bool $Preview = false,
    public bool $Info = false,
    public bool $Invite = false,
    public bool $Pin = false
  ){
    if($Data !== null):
      foreach(self::Array as $perm => $vector):
        $this->$perm = $Data[$vector] ?? false;
      endforeach;
    endif;
  }
}

enum TgMenuButton:string{
  case Default = 'default';
  case Commands = 'commands';
  case WebApp = 'web_app';
}