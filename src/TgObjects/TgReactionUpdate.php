<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgReactionType;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * If $User are null, its an annonimous reaction and $New have an array of TgReaction
 * @param TgReaction|TgReaction[]|null $New
 * @link https://core.telegram.org/bots/api#messagereactionupdated
 * @link https://core.telegram.org/bots/api#messagereactioncountupdated
 * @version 2025.06.15.00
 */
final readonly class TgReactionUpdate
implements TgEventInterface{
  public TgMessageData $Data;
  public int $Message;
  public TgReaction|null $Old;
  public TgReaction|array|null $New;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Message = $Data['message_id'];
    if(isset($Data['reactions'])):
      $temp = [];
      foreach($Data['reactions'] as $reaction):
        $temp[] = new TgReaction(
          Type: TgReactionType::from($reaction['type']['type']),
          Emoji: $reaction['type']['emoji'],
          Count: $reaction['total_count']
        );
      endforeach;
      $this->New = $temp;
      return;
    endif;
    if($Data['old_reaction'] === []):
      $this->Old = null;
    else:
      $this->Old = new TgReaction($Data['old_reaction'][0]);
    endif;
    if($Data['new_reaction'] === []):
      $this->New = null;
    else:
      $this->New = new TgReaction($Data['new_reaction'][0]);
    endif;
  }
}