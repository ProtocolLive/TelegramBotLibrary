<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgPhotoSize;

/**
 * @link https://core.telegram.org/bots/api#userprofilephotos
 * @version 2025.06.01.00
 */
final readonly class TgProfilePhoto{
  public int $Count;
  public array $Photos;

  public function __construct(
    array $Data
  ){
    $this->Count = $Data['total_count'];
    foreach($Data['photos'] as &$photo1):
      foreach($photo1 as &$photo2):
        $photo2 = new TgPhotoSize($photo2);
      endforeach;
    endforeach;
    $this->Photos = $Data['photos'];
  }
}