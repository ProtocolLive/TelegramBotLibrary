<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\{
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
 * @link https://core.telegram.org/bots/api#video
 * @version 2025.07.03.00
 */
readonly class TgVideo
implements TgCaptionableInterface,
TgEventInterface,
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
   * Video thumbnail
   */
  public TgPhotoSize|null $Thumbnail;
  /**
   * Video width as defined by sender
   */
  public int $Width;
  /**
   * Video height as defined by sender
   */
  public int $Height;
  /**
   * Duration of the video in seconds as defined by sender
   */
  public int $Duration;
  /**
   * File size in bytes. It can be bigger than 2^31 and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this value.
   */
  public string $Size;
  /**
   * MIME type of the file as defined by sender
   */
  public string $Mime;
  /**
   * Available sizes of the cover of the video in the message
   * @var TgPhotoSize[]
   */
  public array $Cover;
  /**
   * Timestamp in seconds from which the video will play in the message
   */
  public int $Start;

  public function __construct(
    array $Data
  ){
    if(isset($Data['message_id'])):
      $this->Data = new TgMessageData($Data);
    else:
      $this->Data = null;
    endif;
    $this->Id = $Data['video']['file_id'] ?? $Data['file_id'];
    $this->IdUnique = $Data['video']['file_unique_id'] ?? $Data['file_unique_id'];
    if(isset($Data['video']['thumbnail'])
    or isset($Data['thumbnail'])):
      $this->Thumbnail = new TgPhotoSize($Data['video']['thumbnail'] ?? $Data['thumbnail']);
    else:
      $this->Thumbnail = null;
    endif;
    $this->Width = $Data['video']['width'] ?? $Data['width'];
    $this->Height = $Data['video']['height'] ?? $Data['height'];
    $this->Duration = $Data['video']['duration'] ?? $Data['duration'];
    $this->Size = $Data['video']['file_size'] ?? $Data['file_size'];
    $this->Mime = $Data['video']['mime_type'] ?? $Data['mime_type'];
    $this->Start = $Data['video']['start'] ?? 0;

    foreach($Data['video']['cover'] ?? [] as &$cover):
      $cover = new TgPhotoSize($cover);
    endforeach;
    $this->Cover = $Data['video']['cover'] ?? [];
  }
}