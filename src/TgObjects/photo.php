<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.03.08.00

class TgPhoto extends TgMedia{
  public array $Files;
  public readonly string|null $Caption;
  public array $Entities = [];

  public function __construct(array $Data){
    parent::__construct($Data);
    foreach($Data['photo'] as $file):
      $this->Files[] = new TgPhotoSize($file);
    endforeach;
    $this->Caption = $Data['caption'] ?? null;
    if(isset($Data['caption_entities'])):
      foreach($Data['caption_entities'] as $entity):
        $this->Entities[] = new TgEntity($entity);
      endforeach;
    endif;
  }
}

/**
 * @link https://core.telegram.org/bots/api#photosize
 */
class TgPhotoSize{
  public readonly string $Id;
  public readonly string $IdUnique;
  public readonly int $Size;
  public readonly int $Width;
  public readonly int $Height;

  public function __construct(array $Data){
    $this->Id = $Data['file_id'];
    $this->IdUnique = $Data['file_unique_id'];
    $this->Size = $Data['file_size'];
    $this->Width = $Data['width'];
    $this->Height = $Data['height'];
  }
}