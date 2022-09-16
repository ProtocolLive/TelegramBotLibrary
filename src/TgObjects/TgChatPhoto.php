<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.09.16.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

class TgChatPhoto{
  public readonly string $SmallId;
  public readonly string $SmallIdUnique;
  public readonly string $BigId;
  public readonly string $BigIdUnique;

  public function __construct(array $Data){
    $this->SmallId = $Data['small_file_id'];
    $this->SmallIdUnique = $Data['small_file_unique_id'];
    $this->BigId = $Data['big_file_id'];
    $this->BigIdUnique = $Data['big_file_unique_id'];
  }
}