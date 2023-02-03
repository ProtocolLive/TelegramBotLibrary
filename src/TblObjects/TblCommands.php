<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.02.03.00

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgLimits;

final class TblCommands{
  private array $Commands = [];

  public function __construct(
    array $Data = null
  ){
    if($Data !== null):
      foreach($Data as $cmd):
        $this->Commands[$cmd['command']] = $cmd['description'];
      endforeach;
    endif;
  }

  /**
   * In case of conflicts, the last description are used
   * @throws TblException
   */
  public function Add(
    string $Command,
    string $Description
  ):void{
    if(strlen($Command) > TgLimits::Command):
      throw new TblException(TblError::LimitCommand, 'Command exceeds ' . TgLimits::Command);
    elseif(strlen($Description) > TgLimits::CmdDescription):
      throw new TblException(TblError::LimitCmdDescription, 'Description exceeds ' . TgLimits::CmdDescription);
    endif;
    $this->Commands[$Command] = $Description;
  }

  public function Count():int{
    return count($this->Commands);
  }

  public function Del(
    string $Command
  ):void{
    unset($this->Commands[$Command]);
  }

  /**
   * Returns all commands as an associative array, a specific command description or null if command are not found
   */
  public function Get(
    string $Command = null
  ):array|string|null{
    if($Command === null):
      return $this->Commands;
    else:
      return $this->Commands[$Command] ?? null;
    endif;
  }

  public function Merge(self $Commands):void{
    foreach($Commands->Get() as $cmd => $description):
      $this->Add($cmd, $description);
    endforeach;
  }

  public function ToArray():array{
    $return = [];
    foreach($this->Commands as $cmd => $description):
      $return[] = [
        'command' => $cmd,
        'description' => $description
      ];
    endforeach;
    return $return;
  }
}