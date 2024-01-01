<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgMemberStatus;

/**
 * This object contains information about one member of a chat. Currently, the following 6 types of chat members are supported:
 * @link https://core.telegram.org/bots/api#chatmember
 * @version 2024.01.01.00
 */
final class TgMember{
  /**
   * Information about the user
   */
  public readonly TgUser $Member;
  /**
   * If the user is a member of the chat at the moment of the request
   * @link https://core.telegram.org/bots/api#chatmemberrestricted
   */
  public readonly bool $In;
  /**
   * The member's status in the chat.
   */
  public readonly TgMemberStatus $Status;
  /**
   * @link https://core.telegram.org/bots/api#chatmemberadministrator
   */
  public readonly TgPermAdmin $AdminPerms;
  /**
   * @link https://core.telegram.org/bots/api#chatmemberrestricted
   */
  public readonly TgPermMember $MemberPerms;
  /**
   * If the user's presence in the chat is hidden
   */
  public readonly bool $Anonymous;
  /**
   * Custom title for this user
   */
  public readonly string|null $Title;
  /**
   * Date when restrictions will be lifted for this user; unix time. If 0, then the user is banned forever
   * @link https://core.telegram.org/bots/api#chatmemberbanned
   */
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
      $this->AdminPerms = new TgPermAdmin(
        null,
        true,
        true,
        true,
        true,
        true,
        true,
        true,
        true,
        true,
        true,
        true,
        true,
        true,
        true,
        true
      );
      $this->MemberPerms = new TgPermMember(
        null,
        true,
        true,
        true,
        true,
        true,
        true,
        true,
        true,
        true,
        true,
        true,
        true,
        true,
        true,
        true
      );
    else:
      $this->AdminPerms = new TgPermAdmin($Data);
      $this->MemberPerms = new TgPermMember($Data);
    endif;
  }
}