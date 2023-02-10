<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.02.10.00

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgLimits,
  TgParseMode
};

/**
 * @link https://core.telegram.org/bots/api#inputmediaphoto
 */
final class TblMediaPhoto
extends TblMedia{
  public function __construct(
    private string $Media,
    private string|null $Caption = null,
    private TgParseMode|null $ParseMode = null,
    private TblEntities|null $Entities = null,
    private bool $Spoiler = false
  ){}

  public function Get():array{
    $param = [
      'type' => 'photo',
      'media' => $this->Media
    ];
    if($this->Caption !== null):
      if(mb_strlen(strip_tags($this->Caption)) > TgLimits::Caption):
        throw new TblException(TblError::LimitPhotoCaption);
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
      $param['has_spoiler'] = 'true';
    endif;
    return $param;
  }
}