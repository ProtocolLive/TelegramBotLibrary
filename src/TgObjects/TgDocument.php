<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\{
  TgEntity,
  TgMessageData,
  TgPhotoSize
};
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgForwadableInterface,
  TgMessageInterface
};

/**
 * This object represents a general file (as opposed to photos, voice messages and audio files).
 * @link https://core.telegram.org/bots/api#document
 * @version 2025.07.04.00
 */
readonly class TgDocument
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
   * Original filename as defined by sender. Can be null in case of chat background
   */
  public string|null $Name;
  /**
   * Document thumbnail as defined by sender
   */
  public TgPhotoSize|null $Thumbnail;
  /**
   * MIME type of the file as defined by sender
   */
  public string $Mime;
  /**
   * File size in bytes. It can be bigger than 2^31 and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this value.
   */
  public int $Size;
  /**
   * The unique identifier of a media message group this message belongs to
   */
  public string|null $MediaGroup;

  public function __construct(
    array $Data
  ){
    parent::__construct($Data);
    if(isset($Data['message_id'])):
      $this->Data = new TgMessageData($Data);
    else:
      $this->Data = null;
    endif;
    $this->Id = $Data['document']['file_id'] ?? $Data['file_id'];
    $this->IdUnique = $Data['document']['file_unique_id'] ?? $Data['file_unique_id'];
    $this->Name = $Data['document']['file_name'] ?? $Data['file_name'] ?? null;
    $this->Mime = $Data['document']['mime_type'] ?? $Data['mime_type'];
    $this->Size = $Data['document']['file_size'] ?? $Data['file_size'];
    $this->MediaGroup = $Data['media_group_id'] ?? null;
    $this->Caption = $Data['caption'] ?? null;
    if(isset($Data['document']['thumbnail'])
    or isset($Data['thumbnail'])):
      $this->Thumbnail = new TgPhotoSize($Data['document']['thumbnail'] ?? $Data['thumbnail']);
    else:
      $this->Thumbnail = null;
    endif;

    foreach($Data['caption_entities'] ?? [] as &$entity):
      $entity = new TgEntity($entity);
    endforeach;
    $this->Entities = $Data['caption_entities'] ?? [];
  }
}