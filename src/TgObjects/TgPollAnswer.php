<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * This object represents an answer of a user in a non-anonymous poll.
 * @link https://core.telegram.org/bots/api#pollanswer
 * @version 2024.07.04.00
 */
final readonly class TgPollAnswer
implements TgEventInterface{
  public TgMessageData $Data;
  /**
   * Unique poll identifier
   */
  public string $Id;
  /**
   * 0-based identifiers of chosen answer options. May be empty if the vote was retracted.
   */
  public array $Options;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Id = $Data['poll_id'];
    $this->Options = $Data['option_ids'];
  }
}