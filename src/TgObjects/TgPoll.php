<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\{
  TgEntity,
  TgMessageData,
  TgPollOption
};
use ProtocolLive\TelegramBotLibrary\TgEnums\TgPollType;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgForwadableInterface,
  TgMessageInterface
};

/**
 * This object contains information about a poll.
 * @link https://core.telegram.org/bots/api#poll
 * @version 2026.04.30.00
 */
readonly class TgPoll
implements TgEventInterface,
TgForwadableInterface,
TgMessageInterface{
  public TgMessageData|null $Data;
  /**
   * Unique poll identifier
   */
  public string $PollId;
  /**
   * Poll type, currently can be “regular” or “quiz”
   */
  public TgPollType $Type;
  /**
   * Poll question, 1-300 characters
   */
  public string $Question;
  /**
   * If the poll allows multiple answers
   */
  public bool $Multiple;
  /**
   * List of poll options
   */
  public array $Options;
  /**
   * Total number of users that voted in the poll
   */
  public int $Votes;
  /**
   * If the poll is closed
   */
  public bool $Closed;
  /**
   * If the poll is anonymous
   */
  public bool $Anonymous;
  /**
   * Array of 0-based identifiers of the correct answer options. Available only for polls in quiz mode which are closed or were sent (not forwarded) by the bot or to the private chat with the bot.
   */
  public array $Answers;
  /**
   * Text that is shown when a user chooses an incorrect answer or taps on the lamp icon in a quiz-style poll, 0-200 characters
  */
  public string|null $Explanation;
  /**
   * Special entities that appear in the question. Currently, only custom emoji entities are allowed in poll questions
   */
  public array $QuestionEntities;
  /**
   * Special entities like usernames, URLs, bot commands, etc. that appear in the explanation
   */
  public array $ExplanationEntities;
  /**
   * If the poll allows to change the chosen answer options
   */
  public bool $Revote;
  /**
   * Description of the poll; for polls inside the Message object only
   */
  public string|null $Description;
  /**
   * Special entities like usernames, URLs, bot commands, etc. that appear in the description
   */
  public array $DescriptionEntities;

  public function __construct(
    array $Data
  ){
    if(isset($Data['poll'])):
      $this->Data = new TgMessageData($Data);
      $pointer = &$Data['poll'];
    else:
      $this->Data = null;
      $pointer = &$Data;
    endif;
    $this->PollId = $pointer['id'];
    $this->Question = $pointer['question'];
    $this->Type = TgPollType::tryFrom($pointer['type']);
    $this->Multiple = $pointer['allows_multiple_answers'];
    $this->Votes = $pointer['total_voter_count'];
    $this->Closed = $pointer['is_closed'];
    $this->Anonymous = $pointer['is_anonymous'];
    $this->Answers = $pointer['correct_option_ids'] ?? [];
    $this->Explanation = $pointer['explanation'] ?? null;
    $this->Description = $pointer['description'] ?? null;
    $this->Revote = $pointer['allows_revoting'] ?? false;

    foreach($pointer['options'] as &$option):
      $option = new TgPollOption($option);
    endforeach;
    $this->Options = $pointer['options'];

    foreach($pointer['question_entities'] ?? [] as &$entity):
      $entity = new TgEntity($entity);
    endforeach;
    $this->QuestionEntities = $pointer['question_entities'] ?? [];

    foreach($pointer['explanation_entities'] ?? [] as &$entity):
      $entity = new TgEntity($entity);
    endforeach;
    $this->ExplanationEntities = $pointer['explanation_entities'] ?? [];

    foreach($pointer['description_entities'] ?? [] as &$entity):
      $entity = new TgEntity($entity);
    endforeach;
    $this->DescriptionEntities = $pointer['description_entities'] ?? [];
  }
}