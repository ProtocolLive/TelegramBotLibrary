<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgService;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgServiceInterface
};
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgMessageData,
  TgPhotoSize
};

/**
 * This object represents a chat photo.
 * @link https://core.telegram.org/bots/api#chatphoto
 * @version 2024.01.01.02
 */
final class TgChatPhotoNew
implements TgServiceInterface, TgEventInterface{
  public readonly TgMessageData $Data;
  public array $Photo = [];

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    foreach($Data['new_chat_photo'] as $photo):
      $this->Photo[] = new TgPhotoSize($photo);
    endforeach;
  }
}