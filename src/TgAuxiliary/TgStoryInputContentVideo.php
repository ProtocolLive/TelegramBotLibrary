<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;
use CURLFile;
use Exception;

/**
 * Describes a video to post as a story.
 * @link https://core.telegram.org/bots/api#inputstorycontentvideo
 * @version 2025.05.11.00
 */
final class TgStoryInputContentVideo{
  /**
   * @param string $File The video to post as a story. The video must be of the size 720x1280, streamable, encoded with H.265 codec, with key frames added each second in the MPEG4 format, and must not exceed 30 MB. The video can't be reused and can only be uploaded as a new file, so you can pass “attach://<file_attach_name>” if the video was uploaded using multipart/form-data under <file_attach_name>.
   * @param float|null $Duration Precise duration of the video in seconds; 0-60
   * @param float|null $CoverTimestamp Timestamp in seconds of the frame that will be used as the static cover for the story. Defaults to 0.0.
   * @throws Exception
   */
  public function __construct(
    public string $File,
    public float|null $Duration = null,
    public float|null $CoverTimestamp = null,
    public bool $NoSound = false
  ){
    if(is_file($File) === false):
      throw new Exception('File not found');
    endif;
  }

  public function ToArray():array{
    $param['type'] = 'video';
    $param['video'] = new CURLFile($this->File);
    if($this->Duration >= 0):
      $param['duration'] = $this->Duration;
    endif;
    if($this->CoverTimestamp > 0):
      $param['cover_frame_timestamp'] = $this->CoverTimestamp;
    endif;
    if($this->NoSound):
      $param['is_animation'] = true;
    endif;
    return $param;
  }
}