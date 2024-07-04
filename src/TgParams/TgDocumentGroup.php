<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgParams;
use ProtocolLive\TelegramBotLibrary\TblObjects\{
  TblEntities,
  TblException
};
use ProtocolLive\TelegramBotLibrary\TgEnums\{
  TgError,
  TgParseMode
};
use ProtocolLive\TelegramBotLibrary\TgObjects\TgLimits;

/**
 * Represents a general file to be sent.
 * @version 2024.07.04.00
 * @link https://core.telegram.org/bots/api#inputmediadocument
 */
final class TgDocumentGroup{
  /**
   * @param string $Document File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name.
   * @param string $Thumbnail Optional. Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>.
   * @param string $Caption Caption of the document to be sent, 0-1024 characters after entities parsing
   * @param TgParseMode $ParseMode Optional. Mode for parsing entities in the document caption. See formatting options for more details.
   * @param TblEntities $Entities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
   * @param bool $DisableTypeDetect Optional. Disables automatic server-side content type detection for files uploaded using multipart/form-data. Always True, if the document is sent as part of an album.
   */
  public function __construct(
    public string $Document,
    public string|null $Thumbnail = null,
    public string|null $Caption = null,
    public TgParseMode|null $ParseMode = null,
    public TblEntities|null $Entities = null,
    public bool $DisableTypeDetect = true
  ){
    if(mb_strlen(strip_tags($this->Caption)) > TgLimits::Caption):
      throw new TblException(
        TgError::LimitCaption,
        'Caption exceeds ' . TgLimits::Caption . ' characters'
      );
    endif;
  }

  public function ToArray():array{
    $param['type'] = 'document';
    $param['media'] = $this->Document;
    if($this->Thumbnail !== null):
      $param['thumb'] = $this->Thumbnail;
    endif;
    if($this->Caption !== null):
      $param['caption'] = $this->Caption;
      if($this->ParseMode !== null):
        $param['parse_mode'] = $this->ParseMode->value;
      endif;
      if($this->Entities !== null):
        $param['caption_entities'] = $this->Entities->ToArray();
      endif;
    endif;
    if($this->DisableTypeDetect === false):
      $param['disable_content_type_detection'] = false;
    endif;
    return $param;
  }
}