<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgParams;
use CURLFile;

/**
 * @link https://core.telegram.org/bots/api#inputpaidmediaphoto
 * @link https://core.telegram.org/bots/api#inputpaidmediavideo
 * @version 2025.02.13.00
 */
final class TgPaidMedias{
  private array $Medias;

  /**
   * @param bool $Photo File to be sended is a photo or a video
   * @param string $Media File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name.
   * @param string $Thumbnail Only for videos. Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>.
   * @param int $Width Only for videos. Video width
   * @param int $Height Only for videos. Video height
   * @param int $Duration Only for videos. Video duration in seconds
   * @param bool $Streaming Only for videos. If the uploaded video is suitable for streaming
   * @param string $Cover Cover for the video in the message. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name.
   * @param int $Start Start timestamp for the video in the message
   */
  public function __construct(
    bool $Photo,
    string $Media,
    string|null $Thumbnail = null,
    int|null $Width = null,
    int|null $Height = null,
    int|null $Duration = null,
    bool $Streaming = false,
    string|null $Cover = null,
    int|null $Start = 0
  ){
    $this->Add(
      Photo: $Photo,
      Media: $Media,
      Thumbnail: $Thumbnail,
      Width: $Width,
      Height: $Height,
      Duration: $Duration,
      Streaming: $Streaming,
      Cover: $Cover,
      Start: $Start
    );
  }

  /**
   * @param bool $Photo File to be sended is a photo or a video
   * @param string $Media File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name.
   * @param string $Thumbnail Only for videos. Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>.
   * @param int $Width Only for videos. Video width
   * @param int $Height Only for videos. Video height
   * @param int $Duration Only for videos. Video duration in seconds
   * @param bool $Streaming Only for videos. If the uploaded video is suitable for streaming
   * @param string $Cover Cover for the video in the message. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name.
   * @param int $Start Start timestamp for the video in the message
   */
  public function Add(
    bool $Photo,
    string $Media,
    string|null $Thumbnail = null,
    int|null $Width = null,
    int|null $Height = null,
    int|null $Duration = null,
    bool $Streaming = false,
    string|null $Cover = null,
    int $Start = 0
  ):void{
    $temp = ['media' => is_file($Media) ? new CURLFile($Media) : $Media];
    if($Photo):
      $temp['type'] = 'photo';
    else:
      $temp['type'] = 'video';
      if($Thumbnail !== null):
        $temp['thumbnail'] = is_file($Thumbnail) ? new CURLFile($Thumbnail) : $Thumbnail;
      endif;
      if($Width !== null):
        $temp['width'] = $Width;
      endif;
      if($Height !== null):
        $temp['height'] = $Height;
      endif;
      if($Duration !== null):
        $temp['duration'] = $Duration;
      endif;
      if($Streaming):
        $temp['supports_streaming'] = true;
      endif;
      if($Cover !== null):
        $temp['cover'] = is_file($Cover) ? new CURLFile($Cover) : $Cover;
      endif;
      if($Start > 0):
        $temp['start_timestamp'] = $Start;
      endif;
    endif;
    $this->Medias[] = $temp;
  }

  public function ToArray():array{
    return $this->Medias;
  }
}