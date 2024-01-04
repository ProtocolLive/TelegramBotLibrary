<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgForwadableInterface
};

/**
 * @link https://core.telegram.org/bots/api#voice
 * @version 2024.01.04.00
 */
final readonly class TgVoice
implements TgEventInterface, TgForwadableInterface{
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
   * Duration of the audio in seconds as defined by sender
   */
  public int $Duration;
  /**
   * File size in bytes. It can be bigger than 2^31 and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this value.
   */
  public int $Size;
  /**
   * MIME type of the file as defined by sender
   */
  public string $Mime;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Id = $Data['voice']['file_id'];
    $this->IdUnique = $Data['voice']['file_unique_id'];
    $this->Duration = $Data['voice']['duration'];
    $this->Size = $Data['voice']['file_size'];
    $this->Mime = $Data['voice']['mime_type'];
  }
}