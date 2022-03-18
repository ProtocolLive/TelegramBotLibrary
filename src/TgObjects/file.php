<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.03.18.00

class TgFile{
  public readonly string $Id;
  public readonly string $IdUnique;
  public readonly int $Size;
  public readonly string $Path;

  public function __construct(array $Data){
    $this->Id = $Data['file_id'];
    $this->IdUnique = $Data['file_unique_id'];
    $this->Size = $Data['file_size'];
    $this->Path = $Data['file_path'];
  }
}