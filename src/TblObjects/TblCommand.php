<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.19.00

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgLimits;

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