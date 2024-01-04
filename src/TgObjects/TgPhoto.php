<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgForwadableInterface
};

/**
 * Message is a photo, available sizes of the photo
 * @link https://core.telegram.org/bots/api#message
 * @version 2024.01.04.00
 */
readonly class TgPhoto
implements TgEventInterface, TgForwadableInterface{
  public TgMessageData $Data;
  /**
   * @var TgPhotoSize[]
   */
  public array $Files;
  public string|null $MediaGroup;
  public string|null $Caption;
  public array $Entities;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    foreach($Data['photo'] as $file):
      $this->Files[] = new TgPhotoSize($file);
    endforeach;
    $this->MediaGroup = $Data['media_group_id'] ?? null;
    $this->Caption = $Data['caption'] ?? null;
    if(isset($Data['caption_entities'])):
      $temp = [];
      foreach($Data['caption_entities'] as $entity):
        $temp[] = new TgEntity($entity);
      endforeach;
      $this->Entities = $temp;
    else:
      $this->Entities = [];
    endif;
  }
}