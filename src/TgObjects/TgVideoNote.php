<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgForwadableInterface;

/**
 * @link https://core.telegram.org/bots/api#videonote
 * @version 2023.05.23.02
 */
final class TgVideoNote
extends TgObject
implements TgForwadableInterface{
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
   * Video width and height (diameter of the video message) as defined by sender
   */
  public readonly int $Length;
  /**
   * Duration of the video in seconds as defined by sender
   */
  public readonly int $Duration;
  /**
   * Video thumbnail
   */
  public readonly TgPhotoSize|null $Thumb;
  /**
   * File size in bytes
   */
  public readonly int|null $Size;

  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    $this->Id = $Data['file_id'];
    $this->IdUnique = $Data['file_unique_id'];
    $this->Length = $Data['length'];
    $this->Duration = $Data['duration'];
    $this->Thumb = isset($Data['thumb']) ? new TgPhotoSize($Data['thumb']) : null;
    $this->Size = $Data['size'] ?? null;
  }
}