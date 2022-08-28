<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#message
 */
class TgText{
  public readonly TgMessage $Message;
  public readonly string $Text;
  public array $Entities = [];

  /**
   * @link https://core.telegram.org/bots/api#message
   */
  public function __construct(array $Data){
    $this->Message = new TgMessage($Data);
    $this->Text = $Data['text'];
    if(isset($Data['entities'])):
      foreach($Data['entities'] as $entity):
        $this->Entities[] = new TgEntity($entity);
      endforeach;
    endif;
  }
}