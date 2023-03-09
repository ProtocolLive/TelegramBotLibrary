<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.03.09.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#document
 */
class TgDocument{
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
   * Original filename as defined by sender
   */
  public readonly string $Name;
  /**
   * Document thumbnail as defined by sender
   */
  public readonly TgPhotoSize $Thumb;
  /**
   * MIME type of the file as defined by sender
   */
  public readonly string $Mime;
  /**
   * File size in bytes. It can be bigger than 2^31 and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this value.
   */
  public readonly int $Size;
  /**
   * The unique identifier of a media message group this message belongs to
   */
  public readonly string|null $MediaGroup;
  /**
   * Caption for the document
   */
  public readonly string|null $Caption;

  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    $this->Id = $Data['document']['file_id'];
    $this->IdUnique = $Data['document']['file_unique_id'];
    $this->Name = $Data['document']['file_name'];
    $this->Mime = $Data['document']['mime_type'];
    $this->Size = $Data['document']['file_size'];
    $this->MediaGroup = $Data['media_group_id'] ?? null;
    $this->Caption = $Data['caption'] ?? null;
    if(isset($Data['thumbnail'])):
      $this->Thumb = new TgPhotoSize($Data['thumbnail']);
    endif;
  }
}