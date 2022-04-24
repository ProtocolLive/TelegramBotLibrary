<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.04.24.00

/**
 * @link https://core.telegram.org/bots/api#message
 */
class TgText extends TgMessage{
  public readonly string $Text;
  public array $Entities = [];

  /**
   * @link https://core.telegram.org/bots/api#message
   */
  public function __construct(array $Data){
    parent::__construct($Data);
    $this->Text = $Data['text'];
    if(isset($Data['entities'])):
      foreach($Data['entities'] as $entity):
        $this->Entities[] = new TgEntity($entity);
      endforeach;
    endif;
  }
}

/**
 * @link https://core.telegram.org/bots/api#message
 */
class TgTextEdited extends TgText{
  public readonly int $DateEdited;

  /**
   * New version of a message that is known to the bot and was edited
   * @link https://core.telegram.org/bots/api#message
   */
  public function __construct(array $Data){
    parent::__construct($Data);
    $this->DateEdited = $Data['edit_date'];
  }
}