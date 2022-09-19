<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.09.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

class TgPassportFile{
  public readonly string $Id;
  public readonly string $IdUnique;
  public readonly int $Size;
  public readonly int $Date;

  public function __construct(array $Data){
    $this->Id = $Data['file_id'];
    $this->IdUnique = $Data['file_unique_id'];
    $this->Size = $Data['file_size'];
    $this->Date = $Data['file_date'];
  }
}