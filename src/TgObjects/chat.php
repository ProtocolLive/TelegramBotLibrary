<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.03.10.00

enum TgChatType:string{
  case Private = 'private';
  case Group = 'group';
  case GroupSuper = 'supergroup';
  case Channel = 'channel';
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
  public readonly TgAdminPerm $AdminPerms;
  public readonly TgMemberPerm $MemberPerms;
  public readonly bool $Anonymous;
  public readonly string|null $Title;
  public readonly int|null $Expires;

  public function __construct(array $Data){
    $this->Member = new TgUser($Data['user']);
    $this->Status = TgMemberStatus::tryFrom($Data['status']);
    if($this->Status === TgMemberStatus::Restricted):
      $this->In = $Data['is_member'];
    elseif($this->Status === TgMemberStatus::Member):
      $this->In = true;
    elseif($this->Status === TgMemberStatus::Left
    or $this->Status === TgMemberStatus::Banned):
      $this->In = false;
    endif;
    $this->Anonymous = $Data['is_anonymous'];
    $this->Title = $Data['custom_title'] ?? null;
    $this->Expires = $Data['until_date'] ?? null;
    if($this->Status === TgMemberStatus::Creator):
      $this->AdminPerms = new TgAdminPerm(true, false, true, true, true, true, true, true, true);
      $this->MemberPerms = new TgMemberPerm(true, true, true,true, true, true, true, true);
    else:
      $this->AdminPerms = new TgAdminPerm(
        $Data['can_manage_chat'] ?? false,
        $Data['can_be_edited'] ?? false,
        $Data['can_change_info'] ?? false,
        $Data['can_delete_messages'] ?? false,
        $Data['can_invite_users'] ?? false,
        $Data['can_restrict_members'] ?? false,
        $Data['can_pin_messages'] ?? false,
        $Data['can_promote_members'] ?? false,
        $Data['can_manage_voice_chats'] ?? false
      );
      $this->MemberPerms = new TgMemberPerm(
        $Data['can_send_messages'] ?? false,
        $Data['can_send_media_messages'] ?? false,
        $Data['can_send_polls'] ?? false,
        $Data['can_send_other_messages'] ?? false,
        $Data['can_add_web_page_previews'] ?? false,
        $Data['can_change_info'] ?? false,
        $Data['can_invite_users'] ?? false,
        $Data['can_pin_messages'] ?? false
      );
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
class TgAdminPerm{
  /**
   * @param bool $Manage If the administrator can access the chat event log, chat statistics, message statistics in channels, see channel members, see anonymous administrators in supergroups and ignore slow mode. Implied by any other administrator privilege
   * @param bool $Edited If the bot is allowed to edit administrator privileges of that user
   * @param bool $Info If the user is allowed to change the chat title, photo and other settings
   * @param bool $Delete If the administrator can delete messages of other users
   * @param bool $Invite If the user is allowed to invite new users to the chat
   * @param bool $Restrict If the administrator can restrict, ban or unban chat members
   * @param bool $Pin If the user is allowed to pin messages; groups and supergroups only
   * @param bool $Promote If the administrator can add new administrators with a subset of their own privileges or demote administrators that he has promoted, directly or indirectly (promoted by administrators that were appointed by the user)
   * @param bool $Voice If the administrator can manage voice chats
   * @link https://core.telegram.org/bots/api#chatmemberadministrator
   */
  public function __construct(
    public bool $Manage = false,
    public bool $Edited = false,
    public bool $Info = false,
    public bool $Delete = false,
    public bool $Invite = false,
    public bool $Restrict = false,
    public bool $Pin = false,
    public bool $Promote = false,
    public bool $Voice = false
  ){}
}

/**
 * @link https://core.telegram.org/bots/api#chatpermissions
 */
class TgMemberPerm{
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
    public bool $Message = false,
    public bool $Media = false,
    public bool $Poll = false,
    public bool $Media2 = false,
    public bool $Preview = false,
    public bool $Info = false,
    public bool $Invite = false,
    public bool $Pin = false
  ){}
}