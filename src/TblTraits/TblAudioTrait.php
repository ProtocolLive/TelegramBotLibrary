<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblTraits;
use CURLFile;
use ProtocolLive\TelegramBotLibrary\TblObjects\{
  TblEntities,
  TblMarkup
};
use ProtocolLive\TelegramBotLibrary\TblObjects\TblException;
use ProtocolLive\TelegramBotLibrary\TgEnums\{
  TgMethods,
  TgParseMode
};
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgAudio,
  TgCaptionable,
  TgVoice
};
use ProtocolLive\TelegramBotLibrary\TgParams\TgReplyParams;

/**
 * @version 2025.07.04.00
 */
trait TblAudioTrait{
  /**
   * Use this method to send audio files, if you want Telegram clients to display them in the music player. Your audio must be in the .MP3 or .M4A format. Bots can currently send audio files of up to 50 MB in size, this limit may be changed in the future. For sending voice messages, use the sendVoice method instead.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param string $Audio Audio file to send. Pass a file_id as String to send an audio file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get an audio file from the Internet, or upload a new one using multipart/form-data.
   * @param int $Thread Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message will be sent
   * @param string $Caption Audio caption, 0-1024 characters after entities parsing
   * @param TgParseMode $ParseMode Mode for parsing entities in the audio caption. See formatting options for more details.
   * @param TblEntities $Entities A JSON-serialized list of special entities that appear in the caption, which can be specified instead of parse_mode
   * @param int $Duration Duration of the audio in seconds
   * @param string $Performer Performer
   * @param string $Title Track name
   * @param string $Thumbnail Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>.
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param TgReplyParams $Reply Description of the message to reply to
   * @param TblMarkup $Markup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove a reply keyboard or to force a reply from the user. Not supported for messages sent on behalf of a business account
   * @param string $Effect Unique identifier of the message effect to be added to the message; for private chats only
   * @param bool $AllowPaid Allow up to 1000 messages per second, ignoring broadcasting limits for a fee of 0.1 Telegram Stars per message. The relevant Stars will be withdrawn from the bot's balance
   * @return TgAudio On success, the sent Message is returned.
   * @link https://core.telegram.org/bots/api#sendaudio
   * @throws TblException
   */
  public function AudioSend(
    int|string $Chat,
    string $Audio,
    int|null $Thread = null,
    string|null $BusinessId = null,
    string|null $Caption = null,
    TgParseMode|null $ParseMode = null,
    TblEntities|null $Entities = null,
    int|null $Duration = null,
    string|null $Performer = null,
    string|null $Title = null,
    string|null $Thumbnail = null,
    bool $DisableNotification = false,
    bool $Protect = false,
    bool $AllowPaid = false,
    TgReplyParams|null $Reply = null,
    TblMarkup|null $Markup = null,
    string|null $Effect = null
  ):TgAudio{
    $param['chat_id'] = $Chat;
    if(is_file($Audio)):
      $param['audio'] = new CURLFile($Audio);
    else:
      $param['audio'] = $Audio;
    endif;
    if($Thread !== null):
      $param['message_thread_id'] = $Thread;
    endif;
    if(empty($BusinessId) === false):
      $param['business_connection_id'] = $BusinessId;
    endif;
    if(empty($Caption) === false):
      TgCaptionable::CheckLimitCaption($Caption);
      $param['caption'] = $Caption;
      if($ParseMode !== null):
        $param['parse_mode'] = $ParseMode;
      endif;
      if($Entities !== null):
        $param['caption_entities'] = $Entities->ToArray();
      endif;
    endif;
    if($Duration !== null):
      $param['duration'] = $Duration;
    endif;
    if($Performer !== null):
      $param['performer'] = $Performer;
    endif;
    if($Title !== null):
      $param['title'] = $Title;
    endif;
    if($Thumbnail !== null):
        $param['thumb'] = new CURLFile($Thumbnail);
    endif;
    if($DisableNotification):
      $param['disable_notification'] = true;
    endif;
    if($Protect):
      $param['protect_content'] = true;
    endif;
    if($AllowPaid):
      $param['allow_paid_broadcast'] = true;
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
    return new TgAudio($this->ServerMethod(TgMethods::AudioSend, $param, false));
  }

  /**
   * Use this method to send audio files, if you want Telegram clients to display the file as a playable voice message. For this to work, your audio must be in an .OGG file encoded with OPUS (other formats may be sent as Audio or Document). Bots can currently send voice messages of up to 50 MB in size, this limit may be changed in the future.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param string $Voice Audio file to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data.
   * @param int $Thread Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message will be sent
   * @param string $Caption Audio caption, 0-1024 characters after entities parsing
   * @param TgParseMode $ParseMode Mode for parsing entities in the audio caption. See formatting options for more details.
   * @param TblEntities $Entities A JSON-serialized list of special entities that appear in the caption, which can be specified instead of parse_mode
   * @param int $Duration Duration of the audio in seconds
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param TgReplyParams $Reply Description of the message to reply to
   * @param TblMarkup $Markup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove a reply keyboard or to force a reply from the user. Not supported for messages sent on behalf of a business account
   * @param string $Effect Unique identifier of the message effect to be added to the message; for private chats only
   * @param bool $AllowPaid Allow up to 1000 messages per second, ignoring broadcasting limits for a fee of 0.1 Telegram Stars per message. The relevant Stars will be withdrawn from the bot's balance
   * @return TgVoice On success, the sent Message is returned.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#sendvoice
   */
  public function VoiceSend(
    int|string $Chat,
    string $Voice,
    int|null $Thread = null,
    string|null $BusinessId = null,
    string|null $Caption = null,
    TgParseMode|null $ParseMode = null,
    TblEntities|null $Entities = null,
    int|null $Duration = null,
    bool $DisableNotification = false,
    bool $Protect = false,
    bool $AllowPaid = false,
    TgReplyParams|null $Reply = null,
    TblMarkup|null $Markup = null,
    string|null $Effect = null
  ):TgVoice{
    $param['chat_id'] = $Chat;
    if(is_file($Voice)):
      $param['voice'] = new CURLFile($Voice);
    else:
      $param['voice'] = $Voice;
    endif;
    if($Thread !== null):
      $param['message_thread_id'] = $Thread;
    endif;
    if(empty($BusinessId) === false):
      $param['business_connection_id'] = $BusinessId;
    endif;
    if(empty($Caption) === false):
      TgCaptionable::CheckLimitCaption($Caption);
      $param['caption'] = $Caption;
      if($ParseMode !== null):
        $param['parse_mode'] = $ParseMode;
      endif;
      if($Entities !== null):
        $param['caption_entities'] = $Entities->ToArray();
      endif;
    endif;
    if($Duration !== null):
      $param['duration'] = $Duration;
    endif;
    if($DisableNotification):
      $param['disable_notification'] = true;
    endif;
    if($Protect):
      $param['protect_content'] = true;
    endif;
    if($AllowPaid):
      $param['allow_paid_broadcast'] = true;
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
    return new TgVoice($this->ServerMethod(TgMethods::VoiceSend, $param, false));
  }
}