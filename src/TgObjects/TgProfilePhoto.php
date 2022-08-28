<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#userprofilephotos
 */
class TgProfilePhoto{
  public readonly int $Count;
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