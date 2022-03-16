<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.03.16.00

class TgCallback{
  public readonly int $Id;
  public readonly TgUser $User;
  public readonly TgMessage $Message;
  public readonly string $ChatInstance;
  public readonly string $Data;
  public readonly string $Parameter;

  public function __construct(array $Data){
    $this->Id = $Data['id'];
    $this->User = new TgUser($Data['from']);
    $this->Message = new TgMessage($Data['message']);
    $this->ChatInstance = $Data['chat_instance'];
    $temp = explode(' ', $Data['data']);
    $this->Data = $temp[0];
    $this->Parameter = $temp[1] ?? null;
  }
}