<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * This object contains information about a poll.
 * @link https://core.telegram.org/bots/api#poll
 * @version 2023.05.23.00
 */
final class TgPoll
extends TgObject{
  public readonly TgMessageData|null $Data;
  /**
   * Unique poll identifier
   */
  public readonly string $PollId;
  /**
   * Poll type, currently can be “regular” or “quiz”
   */
  public readonly TgPollType $Type;
  /**
   * Poll question, 1-300 characters
   */
  public readonly string $Question;
  /**
   * If the poll allows multiple answers
   */
  public readonly bool $Multiple;
  /**
   * List of poll options
   */
  public array $Options = [];
  /**
   * Total number of users that voted in the poll
   */
  public readonly int $Votes;
  /**
   * If the poll is closed
   */
  public readonly bool $Closed;
  /**
   * If the poll is anonymous
   */
  public readonly bool $Anonymous;
  /**
   * 0-based identifier of the correct answer option. Available only for polls in the quiz mode, which are closed, or was sent (not forwarded) by the bot or to the private chat with the bot.
   */
  public readonly int|null $Answer;
  /**
   * Text that is shown when a user chooses an incorrect answer or taps on the lamp icon in a quiz-style poll, 0-200 characters
   */
  public readonly string|null $Explanation;
  /**
   * Special entities like usernames, URLs, bot commands, etc. that appear in the explanation
   */
  public array $ExplanationEntities = [];

  /**
   * This object contains information about a poll.
   * Param Answer: 0-based identifier of the correct answer option. Available only for polls in the quiz mode, which are closed, or was sent (not forwarded) by the bot or to the private chat with the bot.
   * @link https://core.telegram.org/bots/api#poll
   */
  public function __construct(array $Data){
    if(isset($Data['poll'])):
      $this->Data = new TgMessageData($Data);
      $pointer = &$Data['poll'];
    else:
      $this->Message = null;
      $pointer = &$Data;
    endif;
    $this->PollId = $pointer['id'];
    $this->Question = $pointer['question'];
    $this->Type = TgPollType::tryFrom($pointer['type']);
    foreach($pointer['options'] as $option):
      $this->Options[] = new TgPollOption($option);
    endforeach;
    $this->Multiple = $pointer['allows_multiple_answers'];
    $this->Votes = $pointer['total_voter_count'];
    $this->Closed = $pointer['is_closed'];
    $this->Anonymous = $pointer['is_anonymous'];
    $this->Answer = $pointer['correct_option_id'] ?? null;
    $this->Explanation = $pointer['explanation'] ?? null;
    if(isset($pointer['explanation_entities'])):
      foreach($pointer['explanation_entities'] as $entity):
        $this->ExplanationEntities[] = new TgEntity($entity);
      endforeach;
    endif;
  }
}