<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.12.30.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#message
 */
class TgPhoto{
  public readonly TgMessageData $Data;
  public array $Files;
  public readonly string|null $MediaGroup;
  public readonly string|null $Caption;
  public array $Entities = [];

  /**
   * @link https://core.telegram.org/bots/api#message
   */
  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    foreach($Data['photo'] as $file):
      $this->Files[] = new TgPhotoSize($file);
    endforeach;
    $this->MediaGroup = $Data['media_group_id'] ?? null;
    $this->Caption = $Data['caption'] ?? null;
    if(isset($Data['caption_entities'])):
      foreach($Data['caption_entities'] as $entity):
        $this->Entities[] = new TgEntity($entity);
      endforeach;
    endif;
  }
}