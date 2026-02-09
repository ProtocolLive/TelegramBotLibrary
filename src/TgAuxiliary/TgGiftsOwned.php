<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgGiftType;

/**
 * Contains the list of gifts received and owned by a user or a chat.
 * @link https://core.telegram.org/bots/api#ownedgifts
 * @version 2026.02.09.00
 */
final readonly class TgGiftsOwned{
  /**
   * The total number of gifts owned by the user or the chat
   */
  public int $Total;
  /**
   * Offset for the next request. If empty, then there are no more results
   */
  public string|null $NextOffset;
  /**
   * List of gifts owned by the user or the chat. This object describes a gift received and owned by a user or a chat. Currently, it can be one of OwnedGiftRegular or OwnedGiftUnique
   * @var TgGiftOwnedRegular[]|TgGiftOwnedUnique[]
   * @link https://core.telegram.org/bots/api#ownedgift
   */
  public array $Gifts;

  public function __construct(
    array $Data
  ){
    $this->Total = $Data['total_count'];
    $this->NextOffset = $Data['next_offset'] ?? null;
    foreach($Data['gifts'] as &$gift):
      if($gift['type'] === TgGiftType::Regular->value):
        $gift = new TgGiftOwnedRegular($gift);
      else:
        $gift = new TgGiftOwnedUnique($gift);
      endif;
    endforeach;
    $this->Gifts = $Data['gifts'];
  }
}