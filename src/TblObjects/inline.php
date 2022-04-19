<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.04.19.02

abstract class TblInlineQuery{}

class TblInlineQueryArticle extends TblInlineQuery{
  /**
   * Represents a link to an article or web page.
   * @param string $Id Unique identifier for this result, 1-64 Bytes
   * @param string $Title Title of the result
   * @param TblInlineQueryContent $Message Content of the message to be sent
   * @param TblMarkup $Markup Inline keyboard attached to the message
   * @param string $Url URL of the result
   * @param bool $UrlHide Pass True, if you don't want the URL to be shown in the message
   * @param string $Description Short description of the result
   * @param string $Thumb Url of the thumbnail for the result
   * @param int $ThumbWidth Thumbnail width
   * @param int $ThumbHeight Thumbnail height
   * @link https://core.telegram.org/bots/api#inlinequeryresultarticle
   */
  public function __construct(
    public string $Id,
    public string $Title,
    public TblInlineQueryContent $Message,
    public TblMarkup|null $Markup = null,
    public string|null $Url = null,
    public bool|null $UrlHide = false,
    public string|null $Description = null,
    public string|null $Thumb = null,
    public int|null $ThumbWidth = null,
    public int|null $ThumbHeight = null
  ){}

  public function ToArray():array{
    $param['type'] = 'article';
    $param['id'] = $this->Id;
    $param['title'] = $this->Title;
    if($this->Message !== null):
      $param['input_message_content'] = $this->Message->ToArray();
    endif;
    if($this->Markup !== null):
      $param['reply_markup'] = $this->Markup->ToJson();
    endif;
    if($this->Url !== null):
      $param['url'] = $this->Url;
    endif;
    if($this->UrlHide):
      $param['hide_url'] = 'true';
    endif;
    if($this->Description !== null):
      $param['description'] = $this->Description;
    endif;
    if($this->Thumb !== null):
      $param['thumb_url'] = $this->Thumb;
    endif;
    if($this->ThumbWidth !== null):
      $param['thumb_width'] = $this->ThumbWidth;
    endif;
    if($this->ThumbHeight !== null):
      $param['thumb_height'] = $this->ThumbHeight;
    endif;
    return $param;
  }
}

class TblInlineQueryPhoto extends TblInlineQuery{
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
   * @param array $Entities List of special entities that appear in the caption, which can be specified instead of parse_mode
   * @param TblMarkup $Markup Inline keyboard attached to the message
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
    public array|null $Entities = null,
    public TblMarkup|null $Markup = null,
    public TblInlineQueryContent|null $Message = null
  ){}

  public function ToArray():array{
    $param['type'] = 'photo';
    $param['id'] = $this->Id;
    if($this->FileId !== null):
      $param['photo_file_id'] = $this->FileId;
    else:
      $param['photo_url'] = $this->Url;
      $param['thumb_url'] = $this->Thumb;
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
    endif;
    if($this->ParseMode !== null):
      $param['parse_mode'] = $this->ParseMode->value;
    endif;
    if($this->Entities !== null):
      $param['caption_entities'] = TblEntities::ToJson($this->Entities);
    endif;
    if($this->Markup !== null):
      $param['reply_markup'] = $this->Markup->ToJson();
    endif;
    if($this->Message !== null):
      $param['input_message_content'] = $this->Message->ToArray();
    endif;
    return $param;
  }
}

abstract class TblInlineQueryContent{}

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
      $param['entities'] = TblEntities::ToJson($this->Entities);
    endif;
    if($this->DisablePreview):
      $param['disable_web_page_preview'] = 'true';
    endif;
    return $param;
  }
}