<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;
use CURLFile;
use Exception;

/**
 * Describes a photo to post as a story.
 * @link https://core.telegram.org/bots/api#inputstorycontentphoto
 * @version 2025.05.11.00
 */
readonly final class TgStoryInputContentPhoto{
  /**
   * @param string $File The photo to post as a story. The photo must be of the size 1080x1920 and must not exceed 10 MB. The photo can't be reused and can only be uploaded as a new file, so you can pass “attach://<file_attach_name>” if the photo was uploaded using multipart/form-data under <file_attach_name>.
   * @throws Exception
   */
  public function __construct(
    public string $File
  ){
    if(is_file($File) === false):
      throw new Exception('File not found');
    endif;
  }

  public function ToArray():array{
    return [
      'type' => 'photo',
      'photo' => new CURLFile($this->File)
    ];
  }
}