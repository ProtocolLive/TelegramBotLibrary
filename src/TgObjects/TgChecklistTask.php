<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblEntities;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgEntity;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgParseMode;

/**
 * Describes a task in a checklist.
 * @link https://core.telegram.org/bots/api#checklisttask
 * @link https://core.telegram.org/bots/api#inputchecklisttask
 * @version 2025.07.03.02
 */
final class TgChecklistTask{
  /**
   * @property int $Id Unique identifier of the task
   * @property string $Text Text of the task
   * @property TgParseMode $ParseMode Mode for parsing entities in the text. See formatting options for more details. Used in method ChecklistSend
   * @property TgEntity[]|TblEntities Special entities that appear in the task text. TblEntities in case of use the method ChecklistSend
   */

  /**
   * User that completed the task; omitted if the task wasn't completed
  */
  public TgUser|null $CompleteUser;
  /**
   * Point in time (Unix timestamp) when the task was completed; 0 if the task wasn't completed
  */
  public int|null $CompletedDate;

  /**
   * @param int $Id Unique identifier of the task
   * @param string $Text Text of the task
   * @param TgParseMode $ParseMode Mode for parsing entities in the text. See formatting options for more details. Used in method ChecklistSend
   * @param TgEntity[]|TblEntities Special entities that appear in the task text. TblEntities in case of use the method ChecklistSend
   */
  public function __construct(
    public int|null $Id = null,
    public string|null $Text = null,
    public TgParseMode|null $ParseMode = null,
    public array|TblEntities|null $Entities = null,
    array|null $Data = null,
  ){
    if($Data === null):
      return;
    endif;
    $this->Id = $Data['id'];
    $this->Text = $Data['text'];
    if(isset($Data['completed_by_user'])):
      $this->CompleteUser = new TgUser($Data['completed_by_user']);
    else:
      $this->CompleteUser = null;
    endif;
    $this->CompletedDate = $Data['completed_date'] ?? null;

    foreach($Data['text_entities'] ?? [] as &$entity):
      $entity = new TgEntity($entity);
    endforeach;
    $this->Entities = $Data['text_entities'] ?? [];
  }

  /**
   * @link https://core.telegram.org/bots/api#inputchecklisttask
   */
  public function ToArray():array{
    $return['id'] = $this->Id;
    $return['text'] = $this->Text;
    if(isset($this->ParseMode)):
      $return['parse_mode'] = $this->ParseMode->value;
    endif;
    if(isset($this->Entities)):
      $return['text_entities'] = $this->Entities->ToArray();
    endif;
    return $return;
  }
}