<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblException;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgEntity;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgError;

/**
 * Messages who have a caption
 * @version 2025.07.04.00
 */
abstract readonly class TgCaptionable{
  /**
   * Caption for the animation, audio, document, paid media, photo, video or voice
   */
  public string|null $Caption;
  /**
   * For messages with a caption, special entities like usernames, URLs, bot commands, etc. that appear in the caption
   */
  public array $Entities;

  public function __construct(
    array $Data
  ){
    foreach($Data['caption_entities'] ?? [] as &$entity):
      $entity = new TgEntity($entity);
    endforeach;
    $this->Entities = $Data['caption_entities'] ?? [] ;
  }

  /**
   * @throws TblException
   */
  public static function CheckLimitCaption(
    string $Caption
  ):void{
    if(strlen(strip_tags($Caption)) > TgLimits::Caption):
      throw new TblException(
        TgError::LimitCaption,
        'Caption must be less than ' . TgLimits::Caption . ' characters'
      );
    endif;
  }
}