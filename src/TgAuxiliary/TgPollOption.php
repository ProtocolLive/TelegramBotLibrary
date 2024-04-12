<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;

/**
 * This object contains information about one answer option in a poll.
 * @link https://core.telegram.org/bots/api#polloption
 * @version 2024.04.11.00
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

  public function __construct(
    array $Data
  ){
    $this->Text = $Data['text'];
    $this->Votes = $Data['voter_count'];
  }
}