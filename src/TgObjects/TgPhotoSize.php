<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#photosize
 */
class TgPhotoSize{
  public readonly string $Id;
  public readonly string $IdUnique;
  public readonly int $Size;
  public readonly int $Width;
  public readonly int $Height;

  public function __construct(array $Data){
    $this->Id = $Data['file_id'];
    $this->IdUnique = $Data['file_unique_id'];
    $this->Size = $Data['file_size'];
    $this->Width = $Data['width'];
    $this->Height = $Data['height'];
  }
}