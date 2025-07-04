<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgService;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgServiceInterface
};
use ProtocolLive\TelegramBotLibrary\TgObjects\TgChecklist;
use ProtocolLive\TelegramBotLibrary\TgParams\TgChecklistTask;

/**
 * Describes a service message about tasks added to a checklist.
 * @link https://core.telegram.org/bots/api#checklisttasksadded
 * @version 2025.07.04.00
 */
final readonly class TgChecklistTasksAdded
implements TgEventInterface,
TgServiceInterface{
  public TgMessageData $Data;
  /**
   * Message containing the checklist to which the tasks were added. Note that the Message object in this field will not contain the reply_to_message field even if it itself is a reply.
   */
  public TgChecklist|null $Message;
  /**
   * List of tasks added to the checklist
   * @var TgChecklistTask[]
   */
  public array $Tasks;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    if(isset($Data['checklist_message'])):
      $this->Message = new TgChecklist($Data['checklist_message']);
    else:
      $this->Message = null;
    endif;
    foreach($Data['tasks'] as &$task):
      $task = new TgChecklistTask(Data: $task);
    endforeach;
    $this->Tasks = $Data['tasks'];
  }
}