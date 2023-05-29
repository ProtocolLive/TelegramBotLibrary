<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgForwadableInterface;

/**
 * @link https://core.telegram.org/bots/api#video
 * @version 2023.05.29.00
 */
class TgVideo
extends TgObject
implements TgForwadableInterface{
  /**
   * @param TgMessageData $Data Message data
   */
  public readonly TgMessageData $Data;
  /**
   * @param string $Id Identifier for this file, which can be used to download or reuse the file
   */
  public readonly string $Id;
  /**
   * @param string $IdUnique Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
   */
  public readonly string $IdUnique;
  /**
   * @param TgPhotoSize $Thumb Video thumbnail
   */
  public readonly TgPhotoSize $Thumb;
  /**
   * @param int $Width Video width as defined by sender
   */
  public readonly int $Width;
  /**
   * @param int $Height Video height as defined by sender
   */
  public readonly int $Height;
  /**
   * @param int $Duration Duration of the video in seconds as defined by sender
   */
  public readonly int $Duration;
  /**
   * @param string $Size File size in bytes. It can be bigger than 2^31 and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this value.
   */
  public readonly string $Size;
  /**
   * @param string $Mime MIME type of the file as defined by sender
   */
  public readonly string $Mime;

  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    $this->Id = $Data['video']['file_id'];
    $this->IdUnique = $Data['video']['file_unique_id'];
    $this->Thumb = new TgPhotoSize($Data['video']['thumbnail']);
    $this->Width = $Data['video']['width'];
    $this->Height = $Data['video']['height'];
    $this->Duration = $Data['video']['duration'];
    $this->Size = $Data['video']['file_size'];
    $this->Mime = $Data['video']['mime_type'];
  }
}