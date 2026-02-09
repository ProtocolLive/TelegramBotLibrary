<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgGift,
  TgUser
};

/**
 * Describes a regular gift owned by a user or a chat.
 * @link https://core.telegram.org/bots/api#ownedgiftregular
 * @version 2026.02.09.00
 */
final readonly class TgGiftOwnedRegular{
  /**
   * Information about the regular gift
   */
  public TgGift $Gift;
  /**
   * Unique identifier of the gift for the bot; for gifts received on behalf of business accounts only
   */
  public string|null $GiftId;
  /**
   * Sender of the gift if it is a known user
   */
  public TgUser|null $Sender;
  /**
   * Date the gift was sent in Unix time
   */
  public int $Date;
  /**
   * Text of the message that was added to the gift
   */
  public string|null $Message;
  /**
   * Special entities that appear in the text
   * @var TgEntity[]
   */
  public array|null $Entities;
  /**
   * If the sender and gift text are shown only to the gift receiver; otherwise, everyone will be able to see them
   */
  public bool $Private;
  /**
   * If the gift is displayed on the account's profile page; for gifts received on behalf of business accounts only
   */
  public bool $Saved;
  /**
   * If the gift can be upgraded to a unique gift; for gifts received on behalf of business accounts only
   */
  public bool $Upgradable;
  /**
   * If the gift was refunded and isn't available anymore
   */
  public bool $Refunded;
  /**
   * Number of Telegram Stars that can be claimed by the receiver instead of the gift; omitted if the gift cannot be converted to Telegram Stars
   */
  public int|null $StarCount;
  /**
   * Number of Telegram Stars that were paid by the sender for the ability to upgrade the gift
   */
  public int|null $PrepaidStars;
  /**
   * If the gift's upgrade was purchased after the gift was sent
   */
  public bool $UpgradeSeparate;

  public function __construct(
    array $Data
  ){
    $this->Gift = new TgGift($Data['gift']);
    $this->GiftId = $Data['owned_gift_id'] ?? null;
    if(isset($Data['sender_user'])):
      $this->Sender = new TgUser($Data['sender_user']);
    else:
      $this->Sender = null;
    endif;
    $this->Date = $Data['send_date'];
    $this->Message = $Data['text'] ?? null;
    $this->Private = $Data['is_private'] ?? false;
    $this->Saved = $Data['is_saved'] ?? false;
    $this->Upgradable = $Data['can_be_upgraded'] ?? false;
    $this->Refunded = $Data['was_refunded'] ?? false;
    $this->StarCount = $Data['convert_star_count'] ?? null;
    $this->PrepaidStars = $Data['prepaid_upgrade_star_count'] ?? null;
    $this->UpgradeSeparate = $Data['is_upgrade_separate'] ?? null;
    
    foreach($Data['entities'] ?? [] as &$entity):
      $entity = new TgEntity($entity);
    endforeach;
    $this->Entities = $Data['entities'] ?? [];
  }
}