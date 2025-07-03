<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\{
  TgEntity,
  TgMessageData,
  TgPhotoSize
};
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgCaptionableInterface,
  TgEventInterface,
  TgForwadableInterface,
  TgMessageInterface
};

/**
 * Message is a photo, available sizes of the photo
 * @link https://core.telegram.org/bots/api#message
 * @version 2025.07.03.01
 */
readonly class TgPhoto
implements TgCaptionableInterface,
TgEventInterface,
TgForwadableInterface,
TgMessageInterface{
  /**
   * Can be null in case of command or external reply
   */
  public TgMessageData|null $Data;
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
    $this->MediaGroup = $Data['media_group_id'] ?? null;
    $this->Caption = $Data['caption'] ?? null;

    foreach($Data['photo'] as &$photo):
      $photo = new TgPhotoSize($photo);
    endforeach;
    $this->Files = $Data['photo'];

    foreach($Data['caption_entities'] ?? [] as &$entity):
      $entity = new TgEntity($entity);
    endforeach;
    $this->Entities = $Data['caption_entities'] ?? [] ;
  }
}