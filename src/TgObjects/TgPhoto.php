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
extends TgCaptionable
implements TgEventInterface,
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

  public function __construct(
    array $Data
  ){
    parent::__construct($Data);
    if(isset($Data['message_id'])):
      $this->Data = new TgMessageData($Data);
    else:
      $this->Data = null;
    endif;
    $this->MediaGroup = $Data['media_group_id'] ?? null;

    foreach($Data['photo'] as &$photo):
      $photo = new TgPhotoSize($photo);
    endforeach;
    $this->Files = $Data['photo'];
  }
}