<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\{
  TgEntity,
  TgMessageData
};
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgForwadableInterface,
  TgMessageInterface
};

/**
 * @link https://core.telegram.org/bots/api#message
 * @version 2025.07.03.01
 */
readonly class TgText
implements TgEventInterface,
TgForwadableInterface,
TgMessageInterface{
  public TgMessageData $Data;
  public string $Text;
  /**
   * @var TgEntity[]
   */
  public array $Entities;

  /**
   * @link https://core.telegram.org/bots/api#message
   */
  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Text = $Data['text'];

    foreach($Data['entities'] ?? [] as &$entity):
      $entity = new TgEntity($entity);
    endforeach;
    $this->Entities = $Data['entities'] ?? [];
  }
}