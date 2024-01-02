<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgParams;

/**
 * Describes the options used for link preview generation
 * @link https://core.telegram.org/bots/api#linkpreviewoptions
 * @version 2024.01.02.01
 */
final class TgLinkPreview{
  /**
   * @param bool $Disabled True, if the link preview is disabled
   * @param string $Url URL to use for the link preview. If empty, then the first URL found in the message text will be used
   * @param bool $Big True, if the media in the link preview is suppposed to be enlarged; False, if the media in the link preview is suppposed to be shrunk; ignored if the URL isn't explicitly specified or media size change isn't supported for the preview
   * @param bool $Above True, if the link preview must be shown above the message text; otherwise, the link preview will be shown below the message text
   */
  public function __construct(
    public bool $Disabled = false,
    public string|null $Url = null,
    public bool|null $Big = null,
    public bool $Above = false
  ){}

  public function ToArray():array|null{
    $return = null;
    if($this->Disabled):
      $return['is_disabled'] = $this->Disabled;
    endif;
    if($this->Url !== null):
      $return['url'] = $this->Url;
    endif;
    if($this->Big):
      $return['prefer_large_media'] = true;
    elseif($this->Big === false):
      $return['prefer_small_media'] = true;
    endif;
    if($this->Above):
      $return['show_above_text'] = $this->Above;
    endif;
    return $return;
  }
}