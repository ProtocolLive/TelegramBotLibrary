<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.09.16.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#userprofilephotos
 */
class TgProfilePhoto{
  public readonly int $Count;
  /**
   * @var TgPhotoSize[] $Photos
   */
  public array $Photos = [];

  public function __construct(array $Data){
    $this->Count = $Data['total_count'];
    foreach($Data['photos'] as $photo1):
      $Photo = [];
      foreach($photo1 as $photo2):
        $Photo[] = new TgPhotoSize($photo2);
      endforeach;
      $this->Photos[] = $Photo;
    endforeach;
  }
}