<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\{
  TgError,
  TgParseMode
};
use ProtocolLive\TelegramBotLibrary\TgObjects\TgLimits;

/**
 * @link https://core.telegram.org/bots/api#inputmediaphoto
 * @version 2024.11.02.00
 */
final class TblMediaPhoto
extends TblMedia{
  public function __construct(
    public string $Media,
    public string|null $Caption = null,
    public TgParseMode|null $ParseMode = null,
    public TblEntities|null $Entities = null,
    public bool $Spoiler = false
  ){}

  public function Get():array{
    $param = [
      'type' => 'photo',
      'media' => $this->Media
    ];
    if($this->Caption !== null):
      if(mb_strlen(strip_tags($this->Caption)) > TgLimits::Caption):
        throw new TblException(
          TgError::LimitCaption,
          'Caption bigger than ' . TgLimits::Caption . ' characters'
        );
      endif;
      $param['caption'] = $this->Caption;
    endif;
    if($this->ParseMode !== null):
      $param['parse_mode'] = $this->ParseMode->value;
    endif;
    if($this->Entities !== null):
      $param['caption_entities'] = $this->Entities->ToArray();
    endif;
    if($this->Spoiler):
      $param['has_spoiler'] = true;
    endif;
    return $param;
  }
}