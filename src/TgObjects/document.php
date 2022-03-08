<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.03.08.00

class TgDocument extends TgMedia{
  public readonly string $Id;
  public readonly string $IdUnique;
  public readonly string $Name;
  public readonly string $Mime;
  public readonly int $Size;

  public function __construct(array $Data){
    parent::__construct($Data);
    $this->Id = $Data['document']['file_id'];
    $this->IdUnique = $Data['document']['file_unique_id'];
    $this->Name = $Data['document']['file_name'];
    $this->Mime = $Data['document']['mime_type'];
    $this->Size = $Data['document']['file_size'];
  }
}