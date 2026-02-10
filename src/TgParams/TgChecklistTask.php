<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgParams;
use ProtocolLive\TelegramBotLibrary\TblObjects\{
  TblEntities,
  TblException
};
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgEntity;
use ProtocolLive\TelegramBotLibrary\TgEnums\{
  TgError,
  TgParseMode
};
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgChat,
  TgLimits,
  TgUser
};

/**
 * Describes a task in a checklist.
 * @link https://core.telegram.org/bots/api#checklisttask
 * @link https://core.telegram.org/bots/api#inputchecklisttask
 * @version 2026.02.09.00
 */
final class TgChecklistTask{
  /**
   * User or chat that completed the task; omitted if the task wasn't completed
  */
  public TgUser|TgChat|null $CompletedBy;
  /**
   * Point in time (Unix timestamp) when the task was completed; 0 if the task wasn't completed
  */
  public int|null $CompletedDate;

  /**
   * @param int $Id Unique identifier of the task
   * @param string $Text Text of the task
   * @param TgParseMode $ParseMode Mode for parsing entities in the text. See formatting options for more details. Used in method ChecklistSend
   * @param TgEntity[]|TblEntities Special entities that appear in the task text. TblEntities in case of use the method ChecklistSend
   * @throws TblException
   */
  public function __construct(
    public int|null $Id = null,
    public string|null $Text = null,
    public TgParseMode|null $ParseMode = null,
    public array|TblEntities|null $Entities = null,
    array|null $Data = null
  ){
    if($Data === null):
      return;
    endif;
    if(mb_strlen($Text) > TgLimits::ChecklistTaskText):
      throw new TblException(
        TgError::LimitChecklistTaskText,
        'Text length exceeds ' . TgLimits::ChecklistTaskText . ' characters'
      );
    endif;
    $this->Id = $Data['id'];
    $this->Text = $Data['text'];
    if(isset($Data['completed_by_user'])):
      $this->CompletedBy = new TgUser($Data['completed_by_user']);
    elseif(isset($Data['completed_by_chat'])):
      $this->CompletedBy = new TgChat($Data['completed_by_chat']);
    else:
      $this->CompletedBy = null;
    endif;
    $this->CompletedDate = $Data['completed_date'] ?? null;

    foreach($Data['text_entities'] ?? [] as &$entity):
      $entity = new TgEntity($entity);
    endforeach;
    $this->Entities = $Data['text_entities'] ?? [];
  }

  /**
   * @link https://core.telegram.org/bots/api#inputchecklisttask
   * @throws TblException
   */
  public function ToArray():array{
    if(mb_strlen(strip_tags($this->Text)) > TgLimits::ChecklistTaskText):
      throw new TblException(
        TgError::LimitChecklistTaskText,
        'Text length exceeds ' . TgLimits::ChecklistTaskText . ' characters'
      );
    endif;
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