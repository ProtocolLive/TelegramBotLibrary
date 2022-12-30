<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.12.30.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

class TgVideo{
  public readonly TgMessageData $Data;
  public readonly string $Id;
  public readonly string $IdUnique;
  public readonly TgPhotoSize $Thumb;
  public readonly int $Width;
  public readonly int $Height;
  public readonly int $Duration;
  public readonly string $Size;
  public readonly string $Mime;

  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    $this->FileId = $Data['video']['file_id'];
    $this->FileIdUnique = $Data['video']['file_unique_id'];
    $this->Thumb = new TgPhotoSize($Data['video']['thumb']);
    $this->Width = $Data['video']['width'];
    $this->Height = $Data['video']['height'];
    $this->Duration = $Data['video']['duration'];
    $this->Size = $Data['video']['file_size'];
    $this->Mime = $Data['video']['mime_type'];
  }
}