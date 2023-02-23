<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.02.23.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * This object represents a chat photo.
 * @link https://core.telegram.org/bots/api#chatphoto
 */
class TgChatPhotoNew{
  public readonly TgMessageData $Data;
  public array $Photo;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    foreach($Data['new_chat_photo'] as $photo):
      $this->Photo[] = new TgPhotoSize($photo);
    endforeach;
  }
}