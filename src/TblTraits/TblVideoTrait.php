<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblTraits;
use CURLFile;
use ProtocolLive\TelegramBotLibrary\TblObjects\{
  TblEntities,
  TblException,
  TblMarkup
};
use ProtocolLive\TelegramBotLibrary\TgEnums\{
  TgError,
  TgMethods,
  TgParseMode
};
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgLimits,
  TgVideo,
  TgVideoNote
};
use ProtocolLive\TelegramBotLibrary\TgParams\TgReplyParams;

/**
 * @version 2025.02.13.00
 */
trait TblVideoTrait{
  /**
   * Use this method to send video files, Telegram clients support MPEG4 videos (other formats may be sent as Document). Bots can currently send video files of up to 50 MB in size, this limit may be changed in the future.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param string $Video Video to send. Pass a file_id as String to send a video that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a video from the Internet, or upload a new video using multipart/form-data. More information on Sending Files
   * @param int $Thread Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message will be sent
   * @param int $Duration Duration of sent video in seconds
   * @param int $Width Video width
   * @param int $Height Video height
   * @param string $Thumbnail Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>. More information on Sending Files
   * @param string $Caption Video caption (may also be used when resending videos by file_id), 0-1024 characters after entities parsing
   * @param TgParseMode $ParseMode Mode for parsing entities in the video caption. See formatting options for more details.
   * @param TblEntities $Entities A JSON-serialized list of special entities that appear in the caption, which can be specified instead of parse_mode
   * @param bool $Spoiler Pass True if the video needs to be covered with a spoiler animation
   * @param bool $Streaming Pass True if the uploaded video is suitable for streaming
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param TgReplyParams $Reply If the message is a reply, ID of the original message
   * @param TblMarkup $Markup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
   * @param string $Effect Unique identifier of the message effect to be added to the message; for private chats only
   * @param bool $CaptionAbove If the caption must be shown above the message media
   * @param bool $AllowPaid Allow up to 1000 messages per second, ignoring broadcasting limits for a fee of 0.1 Telegram Stars per message. The relevant Stars will be withdrawn from the bot's balance
   * @param string $Cover Cover for the video in the message. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name.
   * @param int $Start Start timestamp for the video in the message
   * @return TgVideo On success, the sent Message is returned.
   * @link https://core.telegram.org/bots/api#sendvideo
   * @throws TblException
   */
  public function VideoSend(
    int|string $Chat,
    string $Video,
    int|null $Thread = null,
    string|null $BusinessId = null,
    int|null $Duration = null,
    int|null $Width = null,
    int|null $Height = null,
    string|null $Thumbnail = null,
    string|null $Caption = null,
    bool $CaptionAbove = false,
    string $Cover = null,
    string $Start = 0,
    TgParseMode|null $ParseMode = null,
    TblEntities|null $Entities = null,
    bool $Spoiler = false,
    bool $Streaming = false,
    bool $DisableNotification = false,
    bool $Protect = false,
    bool $AllowPaid = false,
    TgReplyParams|null $Reply = null,
    TblMarkup|null $Markup = null,
    string|null $Effect = null
  ):TgVideo|TgVideoNote{
    $param['chat_id'] = $Chat;
    if($BusinessId !== null):
      $param['business_connection_id'] = $BusinessId;
    endif;
    if(is_file($Video)):
      $param['video'] = new CURLFile($Video);
    else:
      $param['video'] = $Video;
    endif;
    if($Thread !== null):
      $param['message_thread_id'] = $Thread;
    endif;
    if($Duration !== null):
      $param['duration'] = $Duration;
    endif;
    if($Width !== null):
      $param['width'] = $Width;
    endif;
    if($Height !== null):
      $param['height'] = $Height;
    endif;
    if($Thumbnail !== null):
      $param['thumbnail'] = $Thumbnail;
    endif;
    if($Caption !== null):
      if(mb_strlen(strip_tags($Caption)) > TgLimits::Caption):
        throw new TblException(
          TgError::LimitCaption,
          'Caption bigger than ' . TgLimits::Caption . ' characters'
        );
      endif;
      $param['caption'] = $Caption;
      if($ParseMode !== null):
        $param['parse_mode'] = $ParseMode->value;
      endif;
    endif;
    if($Entities !== null):
      $param['caption_entities'] = $Entities->ToArray();
    endif;
    if($Spoiler):
      $param['has_spoiler'] = true;
    endif;
    if($AllowPaid):
      $param['allow_paid_broadcast'] = true;
    endif;
    if($Streaming):
      $param['supports_streaming'] = true;
    endif;
    if($DisableNotification):
      $param['disable_notification'] = true;
    endif;
    if($Protect):
      $param['protect_content'] = true;
    endif;
    if($Reply !== null):
      $param['reply_parameters'] = $Reply->ToArray();
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->ToArray();
    endif;
    if($Effect !== null):
      $param['message_effect_id'] = $Effect;
    endif;
    if($CaptionAbove):
      $param['show_caption_above_media'] = true;
    endif;
    if($Cover !== null):
      $param['cover'] = is_file($Cover) ? new CURLFile($Cover) : $Cover;
    endif;
    if($Start > 0):
      $param['start_timestamp'] = $Start;
    endif;
    return parent::DetectMessage($this->ServerMethod(
      TgMethods::VideoSend,
      $param,
      is_file($Video) ? false : true
    ));
  }

  /**
   * As of v.4.0, Telegram clients support rounded square MPEG4 videos of up to 1 minute long. Use this method to send video messages.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param string $Video Video note to send. Pass a file_id as String to send a video note that exists on the Telegram servers (recommended) or upload a new video using multipart/form-data. More information on Sending Files ». Sending video notes by a URL is currently unsupported
   * @param int $Thread Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message will be sent
   * @param int $Duration Duration of sent video in seconds
   * @param int $Length Video width and height, i.e. diameter of the video message
   * @param string $Thumbnail Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>. More information on Sending Files
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param bool $AllowPaid Allow up to 1000 messages per second, ignoring broadcasting limits for a fee of 0.1 Telegram Stars per message. The relevant Stars will be withdrawn from the bot's balance
   * @param TgReplyParams $Reply If the message is a reply, ID of the original message
   * @param TblMarkup $Markup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
   * @param string $Effect Unique identifier of the message effect to be added to the message; for private chats only
   * @return TgVideoNote The sent Message is returned.
   * @link https://core.telegram.org/bots/api#sendvideonote
   * @throws TblException
   */
  public function VideoNoteSend(
    int|string $Chat,
    string $Video,
    int|null $Thread = null,
    string|null $BusinessId = null,
    int|null $Duration = null,
    int|null $Length = null,
    string|null $Thumbnail = null,
    bool $DisableNotification = false,
    bool $Protect = false,
    bool $AllowPaid = false,
    TgReplyParams|null $Reply = null,
    TblMarkup|null $Markup = null,
    string|null $Effect = null
  ):TgVideoNote|TgVideo{
    $param['chat_id'] = $Chat;
    if($BusinessId !== null):
      $param['business_connection_id'] = $BusinessId;
    endif;
    if(is_file($Video)):
      $param['video_note'] = new CURLFile($Video);
    else:
      $param['video_note'] = $Video;
    endif;
    if($Thread !== null):
      $param['message_thread_id'] = $Thread;
    endif;
    if($Duration !== null):
      $param['duration'] = $Duration;
    endif;
    if($Length !== null):
      $param['length'] = $Length;
    endif;
    if($Thumbnail !== null):
      $param['thumbnail'] = $Thumbnail;
    endif;
    if($DisableNotification):
      $param['disable_notification'] = true;
    endif;
    if($Protect):
      $param['protect_content'] = true;
    endif;
    if($Protect):
      $param['allow_paid_broadcast'] = true;
    endif;
    if($Reply !== null):
      $param['reply_parameters'] = $Reply;
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->ToArray();
    endif;
    if($Effect !== null):
      $param['message_effect_id'] = $Effect;
    endif;
    if($AllowPaid):
      $param['allow_paid_broadcast'] = true;
    endif;
    return parent::DetectMessage($this->ServerMethod(
      TgMethods::VideoNoteSend,
      $param,
      is_file($Video) ? false : true
    ));
  }
}