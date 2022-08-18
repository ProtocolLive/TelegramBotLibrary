<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * This object contains information about one answer option in a poll.
 * @link https://core.telegram.org/bots/api#polloption
 */
class TgPollOption{
  /**
   * Option text, 1-100 characters
   */
  public readonly string $Text;
  /**
   * Number of users that voted for this option
   */
  public readonly int $Votes;

  public function __construct(array $Data){
    $this->Text = $Data['text'];
    $this->Votes = $Data['voter_count'];
  }
}