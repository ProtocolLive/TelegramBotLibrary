<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgServiceInterface
};

/**
 * Describes a service message about checklist tasks marked as done or not done.
 * @link https://core.telegram.org/bots/api#checklisttasksdone
 * @version 2025.07.03.00
 */
final readonly class TgChecklistTasksDone
implements TgEventInterface,
TgServiceInterface{
  public TgMessageData $Data;
  /**
   * Message containing the checklist whose tasks were marked as done or not done. Note that the Message object in this field will not contain the reply_to_message field even if it itself is a reply.
   */
  public TgChecklist|null $Message;
  /**
   * Identifiers of the tasks that were marked as done
   * @var int[]
   */
  public array $Done;
  /**
   * Identifiers of the tasks that were marked as not done
   * @var int[]
   */
  public array $DoneNot;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    if(isset($Data['checklist_message'])):
      $this->Message = new TgChecklist($Data['checklist_message']);
    else:
      $this->Message = null;
    endif;
    $this->Done = $Data['checklist_tasks_done']['done'] ?? [];
    $this->DoneNot = $Data['checklist_tasks_done']['done_not'] ?? [];
  }
}