<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.09.24.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#chatinvitelink
 */
class TgChatInviteLink{
  /**
   * The invite link. If the link was created by another chat administrator, then the second part of the link will be replaced with “…”.
   */
  public readonly string $Link;
  /**
   * Invite link name
   */
  public readonly string|null $Name;
  /**
   * Creator of the link
   */
  public readonly TgUser $Creator;
  /**
   * Number of pending join requests created using this link
   */
  public readonly int|null $Pending;
  /**
   * If users joining the chat via the link need to be approved by chat administrators
   */
  public readonly bool $Request;
  /**
   *  If the link is primary
   */
  public readonly bool $Primary;
  /**
   * If the link is revoked
   */
  public readonly bool $Revoked;
  /**
   * Point in time (Unix timestamp) when the link will expire or has been expired
   */
  public readonly int|null $Expire;
  /**
   * The maximum number of users that can be members of the chat simultaneously after joining the chat via this invite link; 1-99999
   */
  public readonly int|null $Limit;

  public function __construct(array $Data){
    $this->Link = $Data['invite_link'];
    $this->Creator = new TgUser($Data['creator']);
    $this->Request = $Data['creates_join_request'];
    $this->Primary = $Data['is_primary'];
    $this->Revoked = $Data['is_revoked'];
    $this->Name = $Data['name'] ?? null;
    $this->Expire = $Data['expire_date'] ?? null;
    $this->Limit = $Data['member_limit'] ?? null;
    $this->Pending = $Data['pending_join_request_count'] ?? null;
  }
}