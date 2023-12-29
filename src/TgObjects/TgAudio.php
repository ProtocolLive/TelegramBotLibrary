<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#audio
 * @version 2023.12.29.00
 */
class TgAudio{
  /**
   * Null in case of external reply
   */
  public readonly TgMessageData|null $Data;
  public readonly string $Id;
  public readonly string $IdUnique;
  public readonly int $Duration;
  public readonly string|null $Performer;
  public readonly string|null $Title;
  public readonly string|null $FileName;
  public readonly int|null $Size;
  public readonly string|null $Mime;
  public readonly TgPhotoSize|null $Thumbnail;

  public function __construct(
    array $Data
  ){
    if(isset($Data['message_id'])):
      $this->Data = new TgMessageData($Data);
    else:
      $this->Data = null;
    endif;
    $this->Id = $Data['audio']['file_id'] ?? $Data['file_id'];
    $this->IdUnique = $Data['audio']['file_unique_id'] ?? $Data['file_unique_id'];
    $this->Duration = $Data['audio']['duration'] ?? $Data['duration'];
    $this->Performer = $Data['audio']['performer'] ?? $Data['performer'] ?? null;
    $this->Title = $Data['audio']['title'] ?? $Data['title'] ?? null;
    $this->FileName = $Data['audio']['file_name'] ?? $Data['file_name'] ?? null;
    $this->Size = $Data['audio']['file_size'] ?? $Data['file_size'] ?? null;
    $this->Mime = $Data['audio']['mime_type'] ?? $Data['mime_type'] ?? null;
    if(isset($Data['audio']['thumbnail'])
    or isset($Data['thumbnail'])):
      $this->Thumbnail = new TgPhotoSize($Data['audio']['thumbnail'] ?? $Data['thumbnail']);
    else:
      $this->Thumbnail = null;
    endif;
  }
}