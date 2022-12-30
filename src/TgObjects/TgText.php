<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.12.30.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#message
 */
class TgText{
  public readonly TgMessageData $Data;
  public readonly string $Text;
  public array $Entities = [];

  /**
   * @link https://core.telegram.org/bots/api#message
   */
  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    $this->Text = $Data['text'];
    if(isset($Data['entities'])):
      foreach($Data['entities'] as $entity):
        $this->Entities[] = new TgEntity($entity);
      endforeach;
    endif;
  }
}