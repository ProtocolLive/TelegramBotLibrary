<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;

use ProtocolLive\TelegramBotLibrary\TgObjects\TgChat;

/**
 * This object describes a unique gift that was upgraded from a regular gift.
 * @link https://core.telegram.org/bots/api#uniquegift
 * @version 2025.08.15.00
 */
final readonly class TgGiftUnique{
  /**
   * Human-readable name of the regular gift from which this unique gift was upgraded
   */
  public string $Name;
  /**
   * Unique name of the gift. This name can be used in https://t.me/nft/... links and story areas
   */
  public string $NameUnique;
  /**
   * Unique number of the upgraded gift among gifts upgraded from the same regular gift
   */
  public int $Number;
  /**
   * Model of the gift
   */
  public TgGiftUniqueModel $Model;
  /**
   * Symbol of the gift
   */
  public TgGiftUniqueSymbol $Symbol;
  /**
   * Backdrop of the gift
   */
  public TgGiftUniqueBackdrop $Backdrop;
  /**
   * Information about the chat that published the gift
   */
  public TgChat|null $Chat;

  public function __construct(
    array $Data
  ){
    $this->Name = $Data['base_name'];
    $this->NameUnique = $Data['name'];
    $this->Number = $Data['number'];
    $this->Model = new TgGiftUniqueModel($Data['model']);
    $this->Symbol = new TgGiftUniqueSymbol($Data['symbol']);
    $this->Backdrop = new TgGiftUniqueBackdrop($Data['backdrop']);
    if($Data['publisher_chat'] !== null):
      $this->Chat = new TgChat($Data['publisher_chat']);
    else:
      $this->Chat = null;
    endif;
  }
}