<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgPollType;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgForwadableInterface,
  TgMessageInterface
};

/**
 * This object contains information about a poll.
 * Param Answer: 0-based identifier of the correct answer option. Available only for polls in the quiz mode, which are closed, or was sent (not forwarded) by the bot or to the private chat with the bot.
 * @link https://core.telegram.org/bots/api#poll
 * @version 2024.04.11.01
 */
final readonly class TgPoll
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
   * 0-based identifier of the correct answer option. Available only for polls in the quiz mode, which are closed, or was sent (not forwarded) by the bot or to the private chat with the bot.
   */
  public int|null $Answer;
  /**
   * Text that is shown when a user chooses an incorrect answer or taps on the lamp icon in a quiz-style poll, 0-200 characters
   */
  public string|null $Explanation;
  /**
   * Special entities like usernames, URLs, bot commands, etc. that appear in the explanation
   */
  public array $ExplanationEntities;

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
    $temp = [];
    foreach($pointer['options'] as $option):
      $temp[] = new TgPollOption($option);
    endforeach;
    $this->Options = $temp;
    $this->Multiple = $pointer['allows_multiple_answers'];
    $this->Votes = $pointer['total_voter_count'];
    $this->Closed = $pointer['is_closed'];
    $this->Anonymous = $pointer['is_anonymous'];
    $this->Answer = $pointer['correct_option_id'] ?? null;
    $this->Explanation = $pointer['explanation'] ?? null;
    if(isset($pointer['explanation_entities'])):
      $temp = [];
      foreach($pointer['explanation_entities'] as $entity):
        $temp[] = new TgEntity($entity);
      endforeach;
      $this->ExplanationEntities = $temp;
    endif;
  }
}