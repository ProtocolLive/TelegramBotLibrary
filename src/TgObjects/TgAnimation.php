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
  TgForwadableInterface
};

/**
 * @link https://core.telegram.org/bots/api#animation
 * @version 2025.07.04.00
 */
readonly class TgAnimation
extends TgCaptionable
implements TgEventInterface,
TgForwadableInterface{
  /**
   * Can be null in case of command, external reply or game message with a animation inside
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
   * Animation thumbnail as defined by sender
   */
  public TgPhotoSize|null $Thumb;
  /**
   * Original animation filename as defined by sender
   */
  public string|null $Name;
  /**
   * MIME type of the file as defined by sender
   */
  public string|null $Mime;
  /**
   * File size in bytes. It can be bigger than 2^31 and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this value.
   */
  public int|null $Size;

  public function __construct(
    array $Data
  ){
    parent::__construct($Data);
    if(isset($Data['message_id'])):
      $this->Data = new TgMessageData($Data);
    else:
      $this->Data = null;
    endif;
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
    $this->Caption = $Data['caption'] ?? null;

    foreach($Data['caption_entities'] ?? [] as &$entity):
      $entity = new TgEntity($entity);
    endforeach;
    $this->Entities = $Data['caption_entities'] ?? [];
  }
}