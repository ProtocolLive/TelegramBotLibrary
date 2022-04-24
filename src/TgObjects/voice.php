<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.04.24.00

class TgVoice{
  public readonly TgMessage $Message;
  public readonly string $Id;
  public readonly string $IdUnique;
  public readonly int $Duration;
  public readonly int $Size;
  public readonly string $Mime;

  public function __construct(array $Data){
    $this->Message = new TgMessage($Data);
    $this->Id = $Data['voice']['file_id'];
    $this->IdUnique = $Data['voice']['file_unique_id'];
    $this->Duration = $Data['voice']['duration'];
    $this->Size = $Data['voice']['file_size'];
    $this->Mime = $Data['voice']['mime_type'];
  }
}