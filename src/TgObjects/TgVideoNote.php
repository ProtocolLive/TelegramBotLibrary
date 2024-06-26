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
 * @link https://core.telegram.org/bots/api#videonote
 * @version 2024.04.11.01
 */
readonly class TgVideoNote
implements TgEventInterface,
TgForwadableInterface,
TgMessageInterface{
  public TgMessageData $Data;
  /**
   * Identifier for this file, which can be used to download or reuse the file
   */
  public string $Id;
  /**
   * Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
   */
  public string $IdUnique;
  /**
   * Video width and height (diameter of the video message) as defined by sender
   */
  public int $Length;
  /**
   * Duration of the video in seconds as defined by sender
   */
  public int $Duration;
  /**
   * Video thumbnail
   */
  public TgPhotoSize|null $Thumb;
  /**
   * File size in bytes
   */
  public int|null $Size;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Id = $Data['video_note']['file_id'];
    $this->IdUnique = $Data['video_note']['file_unique_id'];
    $this->Length = $Data['video_note']['length'];
    $this->Duration = $Data['video_note']['duration'];
    if(isset($Data['video_note']['thumbnail'])):
      $this->Thumb = new TgPhotoSize($Data['video_note']['thumbnail']);
    else:
      $this->Thumb = null;
    endif;
    $this->Size = $Data['video_note']['size'] ?? null;
  }
}