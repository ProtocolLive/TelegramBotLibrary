<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.03.08.00

class TgMedia extends TgMessage{
  public readonly string|null $MediaGroup;

  public function __construct(array $Data){
    parent::__construct($Data);
    $this->MediaGroup = $Data['media_group_id'] ?? null;
  }
}