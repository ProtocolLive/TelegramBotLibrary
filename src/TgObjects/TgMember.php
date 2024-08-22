<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgMemberStatus;

/**
 * This object contains information about one member of a chat. Currently, the following 6 types of chat members are supported: ChatMemberOwner, ChatMemberAdministrator, ChatMemberMember, ChatMemberRestricted, ChatMemberLeft, ChatMemberBanned
 * @link https://core.telegram.org/bots/api#chatmember
 * @version 2024.08.21.00
 */
final readonly class TgMember{
  /**
   * Information about the user
   */
  public TgUser $Member;
  /**
   * If the user is a member of the chat at the moment of the request
   * @link https://core.telegram.org/bots/api#chatmemberrestricted
   */
  public bool $In;
  /**
   * The member's status in the chat.
   */
  public TgMemberStatus $Status;
  /**
   * @link https://core.telegram.org/bots/api#chatmemberadministrator
   */
  public TgPermAdmin $AdminPerms;
  /**
   * @link https://core.telegram.org/bots/api#chatmemberrestricted
   */
  public TgPermMember $MemberPerms;
  /**
   * If the user's presence in the chat is hidden
   */
  public bool $Anonymous;
  /**
   * Custom title for this user
   */
  public string|null $Title;
  /**
   * Date when restrictions will be lifted for this user; unix time. If 0, then the user is banned forever
   * @link https://core.telegram.org/bots/api#chatmemberbanned
   */
  public int|null $Expires;
  /**
   * Date when the user's subscription will expire; Unix time
   * @link https://core.telegram.org/bots/api#chatmembermember
   */
  public int|null $SubscriptionExpires;

  public function __construct(
    array $Data
  ){
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
    if($this->Status === TgMemberStatus::Restricted
    or $this->Status === TgMemberStatus::Banned):
      $this->Expires = $Data['until_date'] ?? null;
    else:
      $this->Expires = null;
    endif;
    if($this->Status === TgMemberStatus::Member):
      $this->SubscriptionExpires = $Data['until_date'] ?? null;
    else:
      $this->SubscriptionExpires = null;
    endif;
    if($this->Status === TgMemberStatus::Creator):
      $this->AdminPerms = new TgPermAdmin(
        Data: null,
        Manage: true,
        Message: true,
        Edited: true,
        Edit: true,
        Delete: true,
        Invite: true,
        Restrict: true,
        Promote: true,
        Video: true,
        Info: true,
        Pin: true,
        Topics: true,
        StoryCreate: true,
        StoryEdit: true,
        StoryDelete: true
      );
      $this->MemberPerms = new TgPermMember(
        Data: null,
        Message: true,
        Media: true,
        Audio: true,
        Documents: true,
        Photos: true,
        Videos: true,
        VideoNote: true,
        VoiceNote: true,
        Poll: true,
        Media2: true,
        Preview: true,
        Info: true,
        Invite: true,
        Pin: true,
        Topics: true
      );
    else:
      $this->AdminPerms = new TgPermAdmin($Data);
      $this->MemberPerms = new TgPermMember($Data);
    endif;
  }
}