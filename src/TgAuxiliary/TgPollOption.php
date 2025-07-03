<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;

/**
 * This object contains information about one answer option in a poll.
 * @link https://core.telegram.org/bots/api#polloption
 * @version 2025.07.03.01
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

  public function __construct(
    array $Data
  ){
    $this->Text = $Data['text'];
    $this->Votes = $Data['voter_count'];

    foreach($Data['text_entities'] ?? [] as &$entity):
      $entity = new TgEntity($entity);
    endforeach;
    $this->Entities = $Data['text_entities'] ?? [];
  }
}