<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgEntity;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * Describes a service message about an option added to a poll.
 * @link https://core.telegram.org/bots/api#polloptionadded
 * @version 2026.04.30.00
 */
final readonly class TgPollOptionAdded
implements TgEventInterface{
  /**
   * Message containing the poll to which the option was added, if known. Note that the Message object in this field will not contain the reply_to_message field even if it itself is a reply.
   */
  public TgPoll $Message;
  /**
   * Unique identifier of the added option
   */
  public string $Id;
  /**
   * Option text
   */
  public string $Text;
  /**
   * Special entities that appear in the option_text
   */
  public array $Entities;

  public function __construct(
    array $Data
  ){
    $this->Message = new TgPoll($Data['poll_message']);
    $this->Id = $Data['option_persistent_id'];
    $this->Text = $Data['option_text'];

    foreach($pointer['option_text_entities'] ?? [] as &$entity):
      $entity = new TgEntity($entity);
    endforeach;
    $this->Entities = $pointer['option_text_entities'] ?? [];
  }
}