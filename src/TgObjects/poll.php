<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.04.22.00

enum TgPollType:string{
  case Regular = 'regular';
  case Quiz = 'quiz';
}

/**
 * This object contains information about a poll.
 * @link https://core.telegram.org/bots/api#poll
 */
class TgPoll{
  public readonly string $PollId;
  public readonly TgPollType $Type;
  public readonly string $Question;
  public readonly bool $Multiple;
  public array $Options = [];
  public readonly int $Votes;
  public readonly bool $Closed;
  public readonly bool $Anonymous;
  public readonly int|null $Answer;
  public readonly string|null $Explanation;
  public array $ExplanationEntities = [];

  /**
   * This object contains information about a poll.
   * Param Answer: 0-based identifier of the correct answer option. Available only for polls in the quiz mode, which are closed, or was sent (not forwarded) by the bot or to the private chat with the bot.
   * @link https://core.telegram.org/bots/api#poll
   */
  public function __construct(array $Data){
    $this->PollId = $Data['id'];
    $this->Type = TgPollType::tryFrom($Data['type']);
    $this->Question = $Data['question'];
    foreach($Data['options'] as $option):
      $this->Options[] = new TgPollOption($option);
    endforeach;
    $this->Multiple = $Data['allows_multiple_answers'];
    $this->Votes = $Data['total_voter_count'];
    $this->Closed = $Data['is_closed'];
    $this->Anonymous = $Data['is_anonymous'];
    $this->Answer = $Data['correct_option_id'] ?? null;
    $this->Explanation = $Data['explanation'] ?? null;
    foreach($Data['explanation_entities'] as $entity):
      $this->ExplanationEntities[] = new TgEntity($entity);
    endforeach;
  }
}

/**
 * When the poll is created, its comes in a message
 * @link https://core.telegram.org/bots/api#poll
 */
class TgPoolMessage extends TgMessage{
  public readonly TgPoll $Poll;

  /**
   * When the poll is created, its comes in a message
   * @link https://core.telegram.org/bots/api#poll
   */
  public function __construct(array $Data){
    parent::__construct($Data);
    $this->Poll = new TgPoll($Data['poll']);
  }
}

/**
 * @link https://core.telegram.org/bots/api#polloption
 */
class TgPollOption{
  public readonly string $Text;
  public readonly int $Votes;

  /**
   * @link https://core.telegram.org/bots/api#polloption
   */
  public function __construct(array $Data){
    $this->Text = $Data['text'];
    $this->Votes = $Data['voter_count'];
  }
}