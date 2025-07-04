<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgParseMode;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgCaptionable;

/**
 * @link https://core.telegram.org/bots/api#inputmediaphoto
 * @version 2025.07.04.00
 */
final class TblMediaPhoto
extends TblMedia{
  public function __construct(
    public string $Media,
    public string|null $Caption = null,
    public TgParseMode|null $ParseMode = null,
    public TblEntities|null $Entities = null,
    public bool $Spoiler = false
  ){
    TgCaptionable::CheckLimitCaption($Caption);
  }

  public function ToArray():array{
    $param['type'] = 'photo';
    $param['media'] = $this->Media;
    if($this->Caption !== null):
      $param['caption'] = $this->Caption;
      if($this->ParseMode !== null):
        $param['parse_mode'] = $this->ParseMode->value;
      endif;
      if($this->Entities !== null):
        $param['caption_entities'] = $this->Entities->ToArray();
      endif;
    endif;
    if($this->Spoiler):
      $param['has_spoiler'] = true;
    endif;
    return $param;
  }
}