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
 * @version 2024.01.04.00
 */
readonly class TgText
implements TgEventInterface, TgForwadableInterface{
  public TgMessageData $Data;
  public string $Text;
  public array $Entities;

  /**
   * @link https://core.telegram.org/bots/api#message
   */
  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Text = $Data['text'];
    if(isset($Data['entities'])):
      $temp = [];
      foreach($Data['entities'] as $entity):
        $temp[] = new TgEntity($entity);
      endforeach;
      $this->Entities = $temp;
    else:
      $this->Entities = [];
    endif;
  }
}