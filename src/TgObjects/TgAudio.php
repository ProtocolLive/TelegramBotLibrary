<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgForwadableInterface
};

/**
 * @link https://core.telegram.org/bots/api#audio
 * @version 2024.01.04.01
 */
final readonly class TgAudio
implements TgEventInterface, TgForwadableInterface{
  /**
   * Null in case of external reply
   */
  public TgMessageData|null $Data;
  public string $Id;
  public string $IdUnique;
  public int $Duration;
  public string|null $Performer;
  public string|null $Title;
  public string|null $FileName;
  public int|null $Size;
  public string|null $Mime;
  public TgPhotoSize|null $Thumbnail;

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