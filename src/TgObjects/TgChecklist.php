<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\{
  TgEntity,
  TgMessageData
};
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgForwadableInterface,
  TgMessageInterface
};

/**
 * Describes a task in a checklist.
 * @link https://core.telegram.org/bots/api#checklist
 * @version 2025.07.03.00
 */
final readonly class TgChecklist
implements TgEventInterface,
TgMessageInterface,
TgForwadableInterface{
  public TgMessageData $Data;
  /**
   * Title of the checklist
   */
  public string $Title;
  /**
   * List of tasks in the checklist
   * @var TgChecklistTask[]
   */
  public array $Tasks;
  /**
   * If users other than the creator of the list can add tasks to the list
   */
  public bool $TaskAdd;
  /**
   * If users other than the creator of the list can mark tasks as done or not done
   */
  public bool $TaskDone;
  /**
   * Special entities that appear in the checklist title
   */
  public array $Entities;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Title = $Data['checklist']['title'];
    foreach($Data['checklist']['tasks'] as &$task):
      $task = new TgChecklistTask(Data: $task);
    endforeach;
    $this->TaskAdd = $Data['checklist']['task_add'] ?? false;
    $this->TaskDone = $Data['checklist']['task_done'] ?? false;

    foreach($Data['title_entities'] ?? [] as &$entity):
      $entity = new TgEntity($entity);
    endforeach;
    $this->Entities = $Data['title_entities'] ?? [];
  }
}