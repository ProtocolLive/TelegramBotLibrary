<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgParams;

use ProtocolLive\TelegramBotLibrary\TblObjects\{
  TblEntities,
  TblException,
  TblMarkup
};
use ProtocolLive\TelegramBotLibrary\TgEnums\TgParseMode;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgInlineQueryContentInterface,
  TgInlineQueryInterface
};
use ProtocolLive\TelegramBotLibrary\TgObjects\TgCaptionable;

/**
 * @link https://core.telegram.org/bots/api#inlinequeryresultphoto
 * @version 2025.07.04.00
 */
class TgInlineQueryPhoto
implements TgInlineQueryInterface{
  /**
   * Represents a link to a photo or a link to a photo stored on the Telegram servers. By default, this photo will be sent by the user with optional caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the photo.
   * @param string $Id Unique identifier for this result, 1-64 bytes
   * @param string $FileId A valid file identifier of the photo
   * @param string $Url A valid URL of the photo. Photo must be in JPEG format. Photo size must not exceed 5MB
   * @param string $Thumb URL of the thumbnail for the photo
   * @param int $Width Width of the photo
   * @param int $Height Height of the photo
   * @param string $Title Title for the result
   * @param string $Description Short description of the result
   * @param string $Caption Caption of the photo to be sent, 0-1024 characters after entities parsing
   * @param TgParseMode $ParseMode Mode for parsing entities in the photo caption. See formatting options for more details.
   * @param TblEntities $Entities List of special entities that appear in the caption, which can be specified instead of parse_mode
   * @param TblMarkup $Markup Inline keyboard attached to the message
   * @throws TblException
   * @link https://core.telegram.org/bots/api#inlinequeryresultcachedphoto
   * @link https://core.telegram.org/bots/api#inlinequeryresultphoto
   */
  public function __construct(
    public string $Id,
    public string|null $FileId = null,
    public string|null $Url = null,
    public string|null $Thumb = null,
    public int|null $Width = null,
    public int|null $Height = null,
    public string|null $Title = null,
    public string|null $Description = null,
    public string|null $Caption = null,
    public TgParseMode|null $ParseMode = null,
    public TblEntities|null $Entities = null,
    public TblMarkup|null $Markup = null,
    public TgInlineQueryContentInterface|null $Message = null
  ){
    TgCaptionable::CheckLimitCaption($Caption);
  }

  public function ToArray():array{
    $param['type'] = 'photo';
    $param['id'] = $this->Id;
    if($this->FileId !== null):
      $param['photo_file_id'] = $this->FileId;
    else:
      $param['photo_url'] = $this->Url;
      $param['thumbnail_url'] = $this->Thumb;
      if($this->Width !== null):
        $param['photo_width'] = $this->Width;
      endif;
      if($this->Height !== null):
        $param['photo_height'] = $this->Height;
      endif;
    endif;
    if($this->Title !== null):
      $param['title'] = $this->Title;
    endif;
    if($this->Description !== null):
      $param['description'] = $this->Description;
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
    if($this->Markup !== null):
      $param['reply_markup'] = $this->Markup->ToArray();
    endif;
    if($this->Message !== null):
      $param['input_message_content'] = $this->Message->ToArray();
    endif;
    return $param;
  }
}