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
  TgForwadableInterface
};

/**
 * @link https://core.telegram.org/bots/api#animation
 * @version 2024.04.11.00
 */
readonly class TgAnimation
implements TgCaptionableInterface,
TgEventInterface,
TgForwadableInterface{
  /**
   * The game message have a animation inside, turning this null
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
  /**
   * Caption for the document
   */
  public string|null $Caption;
  /**
   * For messages with a caption, special entities like usernames, URLs, bot commands, etc. that appear in the caption
   */
  public array|null $Entities;

  public function __construct(
    array $Data
  ){
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
    if(isset($Data['caption_entities'])):
      $temp = [];
      foreach($Data['caption_entities'] as $entity):
        $temp[] = new TgEntity($entity);
      endforeach;
      $this->Entities = $temp;
    endif;
  }
}