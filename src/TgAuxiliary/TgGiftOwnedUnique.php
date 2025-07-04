<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgUser;

/**
 * Describes a unique gift received and owned by a user or a chat.
 * @link https://core.telegram.org/bots/api#ownedgiftunique
 * @version 2025.07.04.00
 */
final readonly class TgGiftOwnedUnique{
  /**
   * Information about the unique gift
   */
  public TgGiftUnique $Gift;
  /**
   * Unique identifier of the received gift for the bot; for gifts received on behalf of business accounts only
   */
  public string|null $Id;
  /**
   * Sender of the gift if it is a known user
   */
  public TgUser|null $SenderUser;
  /**
   * Date the gift was sent in Unix time
   */
  public int $Date;
  /**
   * If the gift is displayed on the account's profile page; for gifts received on behalf of business accounts only
   */
  public bool $Saved;
  /**
   * If the gift can be transferred to another owner; for gifts received on behalf of business accounts only
   */
  public bool $Transfer;
  /**
   * Number of Telegram Stars that must be paid to transfer the gift; omitted if the bot cannot transfer the gift
   */
  public int|null $TransferCost;
  /**
   * Point in time (Unix timestamp) when the gift can be transferred. If it is in the past, then the gift can be transferred now
   */
  public int|null $TransferBefore;

  public function __construct(
    array $Data
  ){
    $this->Gift = new TgGiftUnique($Data['gift']);
    $this->Id = $Data['owned_gift_id'] ?? null;
    if(isset($Data['sender_user'])):
      $this->SenderUser = new TgUser($Data['sender_user']);
    else:
      $this->SenderUser = null;
    endif;
    $this->Date = $Data['send_date'];
    $this->Saved = $Data['is_saved'] ?? false;
    $this->Transfer = $Data['can_be_transferred'] ?? false;
    $this->TransferCost = $Data['transfer_star_count'] ?? null;
    $this->TransferBefore = $Data['next_transfer_date'] ?? null;
  }
}