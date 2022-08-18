<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

use ProtocolLive\TelegramBotLibrary\TgObjects\{TgMessage, TgEntity};

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

class TblCmdEdited extends TblCmd{
  public readonly int $DateEdited;

  public function __construct(array $Data){
    parent::__construct($Data);
    $this->DateEdited = $Data['edit_date'];
  }
}

class TblCommand{
  public readonly string $Command;
  public readonly string $Description;

  /**
   * @param string $Command
   * @param string $Description
   */
  public function __construct(
    string $Command,
    string $Description
  ){
    if(strlen($Command) > TgLimits::Command):
      $this->Error = TblError::LimitCommand;
      return;
    elseif(strlen($Description) > TgLimits::CmdDescription):
      $this->Error = TblError::LimitCmdDescription;
      return;
    endif;
    $this->Command = $Command;
    $this->Description = $Description;
  }

  static public function ToJson(array $Data):string{
    $return = [];
    foreach($Data as $cmd):
      $return[] = [
        'command' => $cmd->Command,
        'description' => $cmd->Description
      ];
    endforeach;
    return json_encode($return);
  }

  static public function ToObject(array $Data):array{
    $return = [];
    foreach($Data as $cmd):
      $return[] = new TblCommand($cmd['command'], $cmd['description']);
    endforeach;
    return $return;
  }
}