<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgService;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\{
  TgMessageData,
  TgPhotoSize
};
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgServiceInterface
};

/**
 * This object represents a chat photo.
 * @link https://core.telegram.org/bots/api#chatphoto
 * @version 2025.06.17.00
 */
final readonly class TgChatPhotoNew
implements TgEventInterface,
TgServiceInterface{
  public TgMessageData $Data;
  public array $Photo;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $temp = [];
    foreach($Data['new_chat_photo'] as $photo):
      $temp[] = new TgPhotoSize($photo);
    endforeach;
    $this->Photo = $temp;
  }
}