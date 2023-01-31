<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.01.30.00

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgEntity,
  TgMessageData
};

class TblCmd{
  public readonly TgMessageData $Data;
  public readonly string $Command;
  public readonly string|null $Parameters;
  public readonly string|null $Target;

  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    $Text = $Data['text'];
    $Entity = new TgEntity($Data['entities'][0]);
    $cmd = substr(
      $Text,
      $Entity->Offset + 1,
      $Entity->Length - 1
    );
    $temp = substr(
      $Text,
      $Entity->Length + 1
    );
    if($temp === ''):
      $this->Parameters = null;
    else:
      $this->Parameters = $temp;
    endif;
    $pos = strpos($cmd, '@');
    if($pos === false):
      $this->Target = null;
    else:
      $this->Target = substr($cmd, $pos + 1);
      $cmd = substr($cmd, 0, $pos);
    endif;
    $this->Command = $cmd;
  }
}