<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * This object represent a list of gifts.
 * @link https://core.telegram.org/bots/api#gifts
 * @version 2024.11.20.00
 */
final readonly class TgGifts{
  /**
   * The list of gifts
   * @var TgGift[]
   */
  public array $Gifts;

  public function __construct(
    array $Data
  ){
    foreach($Data['gifts'] as &$data):
      $data = new TgGift($data);
    endforeach;
    $this->Gifts = $Data;
  }
}