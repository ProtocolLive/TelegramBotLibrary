<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * @version 2024.03.31.01
 * @link https://core.telegram.org/bots/api#businessmessagesdeleted
 */
final readonly class TgMessageDeleted
implements TgEventInterface{
  public TgMessageData $Data;
  /**
   * A JSON-serialized list of identifiers of deleted messages in the chat of the business account
   * @var int[] $Ids
   */
  public array $Ids;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Ids = $Data['message_ids'];
  }
}