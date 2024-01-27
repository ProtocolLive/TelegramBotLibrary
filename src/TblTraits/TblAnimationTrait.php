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
  TgMethods,
  TgParseMode
};
use ProtocolLive\TelegramBotLibrary\TgObjects\TgAnimation;
use ProtocolLive\TelegramBotLibrary\TgParams\TgReplyParams;

/**
 * @version 2024.01.26.00
 */
trait TblAnimationTrait{
  /**
   * Use this method to send animation files (GIF or H.264/MPEG-4 AVC video without sound). Bots can currently send animation files of up to 50 MB in size, this limit may be changed in the future.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param string $Animation Animation to send. Pass a file_id as String to send an animation that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get an animation from the Internet, or upload a new animation using multipart/form-data.
   * @param int $Thread Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
   * @param int $Duration Duration of sent animation in seconds
   * @param int $Width Animation width
   * @param int $Height Animation height
   * @param int $Thumbnail Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>.
   * @param string $Caption Animation caption (may also be used when resending animation by file_id), 0-1024 characters after entities parsing
   * @param TgParseMode $ParseMode Mode for parsing entities in the animation caption. See formatting options for more details.
   * @param TblEntities $Entities A JSON-serialized list of special entities that appear in the caption, which can be specified instead of parse_mode
   * @param bool $Spoiler Pass True if the animation needs to be covered with a spoiler animation
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param TgReplyParams $Reply Description of the message to reply to
   * @param TblMarkup $Markup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
   * @return TgAnimation On success, the sent Message is returned.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#sendanimation
   */
  public function AnimationSend(
    int|string $Chat,
    string $Animation,
    int $Thread = null,
    int $Duration = null,
    int $Width = null,
    int $Height = null,
    int $Thumbnail = null,
    string $Caption = null,
    TgParseMode $ParseMode = null,
    TblEntities $Entities = null,
    bool $Spoiler = false,
    bool $DisableNotification = false,
    bool $Protect = false,
    TgReplyParams $Reply = null,
    TblMarkup $Markup = null
  ):TgAnimation{
    $param['chat_id'] = $Chat;
    if(is_file($Animation)):
      $param['animation'] = new CURLFile($Animation);
    else:
      $param['animation'] = $Animation;
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
      if(is_file($Thumbnail)):
        $param['thumbnail'] = new CURLFile($Thumbnail);
      else:
        $param['thumbnail'] = $Thumbnail;
      endif;
    endif;
    if($Caption !== null):
      $param['caption'] = $Caption;
    endif;
    if($ParseMode !== null):
      $param['parse_mode'] = $ParseMode->value;
    endif;
    if($Entities !== null):
      $param['caption_entities'] = $Entities->toArray();
    endif;
    if($Spoiler):
      $param['has_spoiler'] = true;
    endif;
    if($DisableNotification):
      $param['disable_notification'] = true;
    endif;
    if($Protect):
      $param['protect_content'] = true;
    endif;
    if($Reply !== null):
      $param['reply_to_message_id'] = $Reply->ToArray();
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->ToArray();
    endif;
    return new TgAnimation($this->ServerMethod(TgMethods::AnimationSend, $param));
  }
}