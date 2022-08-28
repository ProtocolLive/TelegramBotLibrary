<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.19.00

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgParseMode;

class TblInlineQueryContentText extends TblInlineQueryContent{
  public function __construct(
    public string $Text,
    public TgParseMode|null $ParseMode = null,
    public array|null $Entities = null,
    public bool $DisablePreview = false
  ){}

  public function ToArray():array{
    $param['message_text'] = $this->Text;
    if($this->ParseMode !== null):
      $param['parse_mode'] = $this->ParseMode->value;
    endif;
    if($this->Entities !== null):
      $param['entities'] = json_encode($this->Entities);
    endif;
    if($this->DisablePreview):
      $param['disable_web_page_preview'] = 'true';
    endif;
    return $param;
  }
}