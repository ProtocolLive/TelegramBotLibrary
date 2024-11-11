<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#chatinvitelink
 * @version 2024.11.09.00
 */
final readonly class TgChatInviteLink{
  /**
   * The invite link. If the link was created by another chat administrator, then the second part of the link will be replaced with “…”.
   */
  public string $Link;
  /**
   * Invite link name
   */
  public string|null $Name;
  /**
   * Creator of the link
   */
  public TgUser $Creator;
  /**
   * Number of pending join requests created using this link
   */
  public int|null $Pending;
  /**
   * If users joining the chat via the link need to be approved by chat administrators
   */
  public bool $Request;
  /**
   *  If the link is primary
   */
  public bool $Primary;
  /**
   * If the link is revoked
   */
  public bool $Revoked;
  /**
   * Point in time (Unix timestamp) when the link will expire or has been expired
   */
  public int|null $Expire;
  /**
   * The maximum number of users that can be members of the chat simultaneously after joining the chat via this invite link; 1-99999
   */
  public int|null $Limit;
  /**
   * The number of seconds the subscription will be active for before the next payment
   */
  public int|null $SubscriptionPeriod;
  /**
   * The amount of Telegram Stars a user must pay initially and after each subsequent subscription period to be a member of the chat using the link
   */
  public int|null $Price;

  public function __construct(
    array $Data
  ){
    $this->Link = $Data['invite_link'];
    $this->Creator = new TgUser($Data['creator']);
    $this->Request = $Data['creates_join_request'];
    $this->Primary = $Data['is_primary'];
    $this->Revoked = $Data['is_revoked'];
    $this->Name = $Data['name'] ?? null;
    $this->Expire = $Data['expire_date'] ?? null;
    $this->Limit = $Data['member_limit'] ?? null;
    $this->Pending = $Data['pending_join_request_count'] ?? null;
    $this->SubscriptionPeriod = $Data['subscription_period'] ?? null;
    $this->Price = $Data['subscription_price'] ?? null;
  }
}