<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgChatType;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * If $User are null, its an annonimous reaction and $New have an array of TgReaction
 * @param TgReaction|TgReaction[]|null $New
 * @link https://core.telegram.org/bots/api#messagereactionupdated
 * @link https://core.telegram.org/bots/api#messagereactioncountupdated
 * @version 2024.01.01.01
 */
final class TgReactionUpdate
implements TgEventInterface{
  public readonly TgChat|TgUser $Chat;
  public readonly TgUser|null $User;
  public readonly int $Message;
  public readonly int $Date;
  public readonly TgReaction|null $Old;
  public TgReaction|array|null $New;

  public function __construct(
    array $Data
  ){
    if($Data['chat']['type'] === TgChatType::Private->value):
      $this->Chat = new TgUser($Data['chat']);
    else:
      $this->Chat = new TgChat($Data['chat']);
    endif;
    if(isset($Data['user'])):
      $this->User = new TgUser($Data['user']);
    else:
      $this->User = null;
    endif;
    $this->Message = $Data['message_id'];
    $this->Date = $Data['date'];
    if(isset($Data['reactions'])):
      foreach($Data['reactions'] as $reaction):
        $this->New[] = new TgReaction(
          $reaction['type'],
          $reaction['total_count']
        );
      endforeach;
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