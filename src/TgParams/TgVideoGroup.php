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
 * Represents a video to be sent.
 * @link https://core.telegram.org/bots/api#inputmediavideo
 * @version 2025.02.13.00
 */
final class TgVideoGroup{
  /**
   * @param string $Document File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name.
   * @param string $Thumbnail Optional. Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>.
   * @param string $Caption Optional. Caption of the document to be sent, 0-1024 characters after entities parsing
   * @param TgParseMode $ParseMode Optional. Mode for parsing entities in the document caption. See formatting options for more details.
   * @param TblEntities $Entities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
   * @param int $Width Optional. Video width
   * @param int $Height Optional. Video height
   * @param int $Duration Optional. Video duration in seconds
   * @param bool $Streaming Optional. Pass True if the uploaded video is suitable for streaming
   * @param bool $Spoiler Optional. Pass True if the photo needs to be covered with a spoiler animation
   * @param string $Cover Cover for the video in the message. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name.
   * @param int $Start Start timestamp for the video in the message
   */
  public function __construct(
    public string $Document,
    public string|null $Thumbnail = null,
    public string|null $Caption = null,
    public string|null $Cover = null,
    public int|null $Start = null,
    public TgParseMode|null $ParseMode = null,
    public TblEntities|null $Entities = null,
    public int|null $Width = null,
    public int|null $Height = null,
    public int|null $Duration = null,
    public bool $Streaming = false,
    public bool $Spoiler = false
  ){
    if(mb_strlen(strip_tags($this->Caption)) > TgLimits::Caption):
      throw new TblException(TgError::LimitCaption, 'Caption exceeds ' . TgLimits::Caption);
    endif;
  }

  public function ToArray():array{
    $param['type'] = 'video';
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
    if($this->Width !== null):
      $param['width'] = $this->Width;
    endif;
    if($this->Height !== null):
      $param['height'] = $this->Height;
    endif;
    if($this->Duration !== null):
      $param['duration'] = $this->Duration;
    endif;
    if($this->Streaming):
      $param['supports_streaming'] = true;
    endif;
    if($this->Spoiler):
      $param['has_spoiler'] = true;
    endif;
    if($this->Cover !== null):
      $param['cover'] = $this->Cover;
    endif;
    if($this->Start !== null):
      $param['start_timestamp'] = $this->Start;
    endif;
    return $param;
  }
}