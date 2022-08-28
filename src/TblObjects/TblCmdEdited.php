<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.19.00

namespace ProtocolLive\TelegramBotLibrary\TblObjects;

class TblCmdEdited extends TblCmd{
  public readonly int $DateEdited;

  public function __construct(array $Data){
    parent::__construct($Data);
    $this->DateEdited = $Data['edit_date'];
  }
}