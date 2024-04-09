<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;

/**
 * This object represents one size of a photo or a file / sticker thumbnail.
 * @link https://core.telegram.org/bots/api#photosize
 * @version 2024.04.09.00
 */
final readonly class TgPhotoSize{
  public string $Id;
  public string $IdUnique;
  public int $Size;
  public int $Width;
  public int $Height;

  public function __construct(
    array $Data
  ){
    $this->Id = $Data['file_id'];
    $this->IdUnique = $Data['file_unique_id'];
    $this->Size = $Data['file_size'];
    $this->Width = $Data['width'];
    $this->Height = $Data['height'];
  }
}