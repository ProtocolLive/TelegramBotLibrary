<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.11.04.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

class TgDocument{
  public readonly TgMessage $Message;
  public readonly string $Id;
  public readonly string $IdUnique;
  public readonly string $Name;
  public readonly string $Mime;
  public readonly int $Size;
  public readonly string|null $MediaGroup;
  public readonly string|null $Caption;

  public function __construct(array $Data){
    $this->Message = new TgMessage($Data);
    $this->Id = $Data['document']['file_id'];
    $this->IdUnique = $Data['document']['file_unique_id'];
    $this->Name = $Data['document']['file_name'];
    $this->Mime = $Data['document']['mime_type'];
    $this->Size = $Data['document']['file_size'];
    $this->MediaGroup = $Data['media_group_id'] ?? null;
    $this->Caption = $Data['caption'] ?? null;
  }
}