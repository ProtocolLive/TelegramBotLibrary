<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\{
  TgGiftOwnedRegular,
  TgGiftOwnedUnique
};

/**
 * Contains the list of gifts received and owned by a user or a chat.
 * @link https://core.telegram.org/bots/api#ownedgifts
 * @version 2025.04.12.00
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
   * The list of gifts
   */
  public array $Gifts;

  public function __construct(
    array $Data
  ){
    $this->Total = $Data['total'];
    $this->NextOffset = $Data['next_offset'];
    foreach($Data['gifts'] as &$data):
      if($data['type'] === 'regular'):
        $data = new TgGiftOwnedRegular($data);
      else:
        $data = new TgGiftOwnedUnique($data);
      endif;
    endforeach;
    $this->Gifts = $Data['gifts'];
  }
}