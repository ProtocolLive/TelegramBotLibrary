<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgForwadableInterface
};

/**
 * @link https://core.telegram.org/bots/api#animation
 * @version 2024.01.01.00
 */
final class TgAnimationEdited
extends TgAnimation
implements TgForwadableInterface, TgEventInterface{
  public readonly TgMessageData $Data;
  /**
   * Identifier for this file, which can be used to download or reuse the file
   */
  public readonly string $Id;
  /**
   * Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
   */
  public readonly string $IdUnique;
  /**
   * Video width as defined by sender
   */
  public readonly int $Width;
  /**
   * Video height as defined by sender
   */
  public readonly int $Height;
  /**
   * Duration of the video in seconds as defined by sender
   */
  public readonly int $Duration;
  /**
   * Animation thumbnail as defined by sender
   */
  public readonly TgPhotoSize|null $Thumb;
  /**
   * Original animation filename as defined by sender
   */
  public readonly string|null $Name;
  /**
   * MIME type of the file as defined by sender
   */
  public readonly string|null $Mime;
  /**
   * File size in bytes. It can be bigger than 2^31 and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this value.
   */
  public readonly int|null $Size;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Id = $Data['animation']['file_id'];
    $this->IdUnique = $Data['animation']['file_unique_id'];
    $this->Width = $Data['animation']['width'];
    $this->Height = $Data['animation']['height'];
    $this->Duration = $Data['animation']['duration'];
    if(isset($Data['thumbnail'])):
      $this->Thumb = new TgPhotoSize($Data['thumbnail']);
    else:
      $this->Thumb = null;
    endif;
    $this->Name = $Data['animation']['file_name'] ?? null;
    $this->Mime = $Data['animation']['mime_type'] ?? null;
    $this->Size = $Data['animation']['file_size'] ?? null;
  }
}