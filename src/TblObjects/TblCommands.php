<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;

/**
 * @version 2026.07.14.00
 */
final class TblCommands{
  private array $Commands = [];

  public function __construct(
    array|null $Data = null
  ){
    if($Data === null):
      return;
    endif;
    foreach($Data as $cmd):
      $this->Commands[$cmd['command']] = new TblCommand(
        $cmd['command'],
        $cmd['description'],
        $cmd['is_ephemeral']
      );
    endforeach;
  }

  /**
   * In case of conflicts, the last description are used
   * @throws TblException
   */
  public function Add(
    TblCommand $Command
  ):void{
    $this->Commands[$Command->Command] = $Command;
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
    string|null $Command = null
  ):array|TblCommand|null{
    return clone $this->Commands[$Command] ?? clone $this->Commands ?? null;
  }

  public function Merge(
    self $Commands
  ):void{
    foreach($Commands->Get() as $data):
      $this->Add(new TblCommand($data->Command, $data->Description, $data->Ephemeral));
    endforeach;
  }

  public function ToArray():array{
    $return = [];
    foreach($this->Commands as $data):
      $return[] = [
        'command' => $data->Command,
        'description' => $data->Description,
        'is_ephemeral' => $data->Ephemeral
      ];
    endforeach;
    return $return;
  }
}