<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgParams;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblMarkup;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgInlineQueryContentInterface,
  TgInlineQueryInterface
};

/**
 * @version 2025.01.02.00
 */
final class TgInlineQueryArticle
implements TgInlineQueryInterface{
  /**
   * Represents a link to an article or web page.
   * @param string $Id Unique identifier for this result, 1-64 Bytes
   * @param string $Title Title of the result
   * @param TgInlineQueryContentInterface $Message Content of the message to be sent
   * @param TblMarkup $Markup Inline keyboard attached to the message
   * @param string $Url URL of the result
   * @param string $Description Short description of the result
   * @param string $Thumb Url of the thumbnail for the result
   * @param int $ThumbWidth Thumbnail width
   * @param int $ThumbHeight Thumbnail height
   * @link https://core.telegram.org/bots/api#inlinequeryresultarticle
   */
  public function __construct(
    public string $Id,
    public string $Title,
    public TgInlineQueryContentInterface $Message,
    public TblMarkup|null $Markup = null,
    public string|null $Url = null,
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
      $param['reply_markup'] = $this->Markup->ToArray();
    endif;
    if($this->Url !== null):
      $param['url'] = $this->Url;
    endif;
    if($this->Description !== null):
      $param['description'] = $this->Description;
    endif;
    if($this->Thumb !== null):
      $param['thumbnail_url'] = $this->Thumb;
    endif;
    if($this->ThumbWidth !== null):
      $param['thumbnail_width'] = $this->ThumbWidth;
    endif;
    if($this->ThumbHeight !== null):
      $param['thumbnail_height'] = $this->ThumbHeight;
    endif;
    return $param;
  }
}