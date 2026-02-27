<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;

/**
 * This object represents a video file of a specific quality.
 * @link https://core.telegram.org/bots/api#videoquality
 * @version 2026.02.27.00
 */
final readonly class TgVideoQuality{
  /**
   * Identifier for this file, which can be used to download or reuse the file
   */
  public string $Id;
  /**
   * Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
   */
  public string $IdUnique;
  /**
   * Video width
   */
  public int $Width;
  /**
   * Video height
   */
  public int $Height;
  /**
   * Codec that was used to encode the video, for example, “h264”, “h265”, or “av01”
   */
  public string $Codec;
  /**
   * File size in bytes. It can be bigger than 2^31 and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this value.
   */
  public int|null $Size;

  public function __construct(
    array $Data
  ){
    $this->Id = $Data['file_id'];
    $this->IdUnique = $Data['file_unique_id'];
    $this->Width = $Data['width'];
    $this->Height = $Data['height'];
    $this->Codec = $Data['codec'];
    $this->Size = $Data['file_size'] ?? null;
  }
}