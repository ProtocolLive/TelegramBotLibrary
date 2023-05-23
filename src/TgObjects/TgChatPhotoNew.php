<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * This object represents a chat photo.
 * @link https://core.telegram.org/bots/api#chatphoto
 * @version 2023.05.23.00
 */
final class TgChatPhotoNew
extends TgObject{
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