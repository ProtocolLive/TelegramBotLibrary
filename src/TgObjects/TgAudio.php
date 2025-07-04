<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\{
  TgMessageData,
  TgPhotoSize
};
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgForwadableInterface,
  TgMessageInterface
};

/**
 * @link https://core.telegram.org/bots/api#audio
 * @version 2025.07.04.00
 */
readonly class TgAudio
extends TgCaptionable
implements TgEventInterface,
TgForwadableInterface,
TgMessageInterface{
  /**
   * Can be null in case of command or external reply
   */
  public TgMessageData|null $Data;
  /**
   * Identifier for this file, which can be used to download or reuse the file
   */
  public string $Id;
  /**
   * Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
   */
  public string $IdUnique;
  /**
   * Caption for the audio
   */
  public string|null $Caption;
  /**
   * Duration of the audio in seconds as defined by the sender
   */
  public int $Duration;
  /**
   * Performer of the audio as defined by the sender or by audio tags
   */
  public string|null $Performer;
  /**
   * Title of the audio as defined by the sender or by audio tags
   */
  public string|null $Title;
  /**
   * Original filename as defined by the sender
   */
  public string|null $FileName;
  /**
   * File size in bytes. It can be bigger than 2^31 and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this value.
   */
  public int|null $Size;
  /**
   * MIME type of the file as defined by the sender
   */
  public string|null $Mime;
  /**
   * Thumbnail of the album cover to which the music file belongs
   */
  public TgPhotoSize|null $Thumbnail;

  public function __construct(
    array $Data
  ){
    parent::__construct($Data);
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