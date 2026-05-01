<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgChat,
  TgUser
};

/**
 * This object contains information about one answer option in a poll.
 * @link https://core.telegram.org/bots/api#polloption
 * @version 2026.04.30.00
 */
final readonly class TgPollOption{
  /**
   * Option text, 1-100 characters
   */
  public string $Text;
  /**
   * Number of users that voted for this option
   */
  public int $Votes;
  /**
   * Special entities that appear in the option text. Currently, only custom emoji entities are allowed in poll option texts
   */
  public array $Entities;
  /**
   * Unique identifier of the option, persistent on option addition and deletion
   */
  public int $Id;
  /**
   * User who added the option; omitted if the option wasn't added by a user after poll creation
   */
  public TgUser|null $User;
  /**
   * Chat that added the option; omitted if the option wasn't added by a chat after poll creation
   */
  public TgChat|null $Chat;
  /**
   * Point in time (Unix timestamp) when the option was added; omitted if the option existed in the original poll
   */
  public int|null $Added;

  public function __construct(
    array $Data
  ){
    $this->Text = $Data['text'];
    $this->Votes = $Data['voter_count'];
    $this->Id = $Data['persistent_id'];
    $this->Added = $Data['addition_date'] ?? null;

    if(isset($Data['added_by_user'])):
      $this->User = new TgUser($Data['added_by_user']);
    else:
      $this->User = null;
    endif;
    if(isset($Data['added_by_chat'])):
      $this->Chat = new TgChat($Data['added_by_chat']);
    else:
      $this->Chat = null;
    endif;

    foreach($Data['text_entities'] ?? [] as &$entity):
      $entity = new TgEntity($entity);
    endforeach;
    $this->Entities = $Data['text_entities'] ?? [];
  }
}