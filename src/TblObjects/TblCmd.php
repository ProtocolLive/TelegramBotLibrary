<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.11.11.00

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgEntity,
  TgMessage
};

class TblCmd{
  public readonly TgMessage $Message;
  public readonly string $Command;
  public readonly string|null $Parameters;
  public readonly string|null $Target;

  public function __construct(array $Data){
    $this->Message = new TgMessage($Data);
    $Text = $Data['text'];
    $Entity = new TgEntity($Data['entities'][0]);
    $this->Command = substr(
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
    $pos = strpos($this->Command, '@');
    if($pos === false):
      $this->Target = null;
    else:
      $this->Target = substr($this->Command, $pos + 1);
      $this->Command = substr($this->Command, 0, $pos);
    endif;
  }
}