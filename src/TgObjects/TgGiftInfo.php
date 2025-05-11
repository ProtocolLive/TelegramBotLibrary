<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgServiceInterface;

/**
 * Describes a service message about a regular gift that was sent or received.
 * @link https://core.telegram.org/bots/api#giftinfo
 * @version 2025.05.11.00
 */
final readonly class TgGiftInfo
implements TgServiceInterface{
  /**
   * Information about the gift
   */
  public TgGift $Gift;
  /**
   * Unique identifier of the received gift for the bot; only present for gifts received on behalf of business accounts
   */
  public string|null $Id;
  /**
   * Number of Telegram Stars that can be claimed by the receiver by converting the gift; omitted if conversion to Telegram Stars is impossible
   */
  public int|null $Stars;
  /**
   * Number of Telegram Stars that were prepaid by the sender for the ability to upgrade the gift
   */
  public int|null $PrepaidStars;
  /**
   * If the gift can be upgraded to a unique gift
   */
  public bool $Upgradable;
  /**
   * Text of the message that was added to the gift
   */
  public string|null $Message;
  /**
   * Special entities that appear in the text
   * @var TgEntity[]
   */
  public array $Entities;
  /**
   * if the sender and gift text are shown only to the gift receiver; otherwise, everyone will be able to see them
   */
  public bool $Private;

  public function __construct(
    array $Data
  ){
    $this->Gift = new TgGift($Data['gift']);
    $this->Id = $Data['owned_gift_id'] ?? null;
    $this->Stars = $Data['convert_star_count'] ?? null;
    $this->PrepaidStars = $Data['prepaid_upgrade_star_count'] ?? null;
    $this->Upgradable = $Data['can_be_upgraded'] ?? false;
    $this->Message = $Data['text'] ?? null;
    if(isset($Data['entities'])):
      $temp = [];
      foreach($Data['entities'] as $entity):
        $temp[] = new TgEntity($entity);
      endforeach;
      $this->Entities = $temp;
    else:
      $this->Entities = [];
    endif;
    $this->Private = $Data['is_private'] ?? false;
  }
}