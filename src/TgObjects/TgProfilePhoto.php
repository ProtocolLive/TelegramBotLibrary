<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgPhotoSize;

/**
 * @link https://core.telegram.org/bots/api#userprofilephotos
 * @version 2024.04.09.00
 */
final readonly class TgProfilePhoto{
  public int $Count;
  /**
   * @var TgPhotoSize[] $Photos
   */
  public array $Photos;

  public function __construct(
    array $Data
  ){
    $this->Count = $Data['total_count'];
    $temp = [];
    foreach($Data['photos'] as $photo1):
      $Photo = [];
      foreach($photo1 as $photo2):
        $Photo[] = new TgPhotoSize($photo2);
      endforeach;
      $temp[] = $Photo;
    endforeach;
    $this->Photos = $temp;
  }
}