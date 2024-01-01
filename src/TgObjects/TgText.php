<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgForwadableInterface
};

/**
 * @link https://core.telegram.org/bots/api#message
 * @version 2024.01.01.00
 */
class TgText
implements TgForwadableInterface, TgEventInterface{
  public readonly TgMessageData $Data;
  public readonly string $Text;
  public array $Entities = [];

  /**
   * @link https://core.telegram.org/bots/api#message
   */
  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Text = $Data['text'];
    if(isset($Data['entities'])):
      foreach($Data['entities'] as $entity):
        $this->Entities[] = new TgEntity($entity);
      endforeach;
    endif;
  }
}