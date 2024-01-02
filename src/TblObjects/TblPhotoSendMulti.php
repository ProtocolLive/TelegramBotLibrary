<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use CURLFile;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgParseMode;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgLimits;
use ProtocolLive\TelegramBotLibrary\TgParams\TgReplyParams;

/**
 * @version 2024.01.02.00
 */
final class TblPhotoSendMulti
extends TblServerMulti{
  public function __construct(
    int $Chat = null,
    string $Photo = null,
    int $Thread = null,
    string $Caption = null,
    TgParseMode $ParseMode = TgParseMode::Html,
    TblEntities $Entities = null,
    bool $DisableNotification = false,
    bool $Protect = false,
    bool $Spoiler = false,
    TgReplyParams $Reply = null,
    TblMarkup $Markup = null,
    string $MultiControl = null
  ){
    if($Chat === null
    or $Photo === null):
      return;
    endif;
    $this->Args[$MultiControl ?? $Chat] = self::BuildArgs(
      $Chat,
      $Photo,
      $Thread,
      $Caption,
      $ParseMode,
      $Entities,
      $DisableNotification,
      $Protect,
      $Spoiler,
      $Reply,
      $Markup
    );
  }

  public function Add(
    int $Chat,
    string $Photo,
    int $Thread = null,
    string $Caption = null,
    TgParseMode $ParseMode = TgParseMode::Html,
    TblEntities $Entities = null,
    bool $DisableNotification = false,
    bool $Protect = false,
    bool $Spoiler = false,
    TgReplyParams $Reply = null,
    TblMarkup $Markup = null,
    string $MultiControl = null
  ):void{
    $this->Args[$MultiControl ?? $Chat] = self::BuildArgs(
      $Chat,
      $Photo,
      $Thread,
      $Caption,
      $ParseMode,
      $Entities,
      $DisableNotification,
      $Protect,
      $Spoiler,
      $Reply,
      $Markup
    );
  }

  /**
   * Use this method with PhotoSendMulti
   * @param int $Chat Unique identifier for the target chat
   * @param string $Photo Photo to send. Pass a file_id as String to send a photo that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a photo from the Internet, or upload a new photo using multipart/form-data. The photo must be at most 10 MB in size. The photo's width and height must not exceed 10000 in total. Width and height ratio must be at most 20.
   * There are three ways to send files (photos, stickers, audio, media, etc.):
   * 1) If the file is already stored somewhere on the Telegram servers, you don't need to re-upload it: each file object has a file_id field, simply pass this file_id as a parameter instead of uploading. There are no limits for files sent this way.
   * 2) Provide Telegram with an HTTP URL for the file to be sent. Telegram will download and send the file. 5 MB max size for photos and 20 MB max for other types of content.
   * 3) Post the file using multipart/form-data in the usual way that files are uploaded via the browser. 10 MB max size for photos, 50 MB for other files.
   * 
   * Sending by file_id
   * - It is not possible to change the file type when resending by file_id. I.e. a video can't be sent as a photo, a photo can't be sent as a document, etc.
   * - It is not possible to resend thumbnails.
   * - Resending a photo by file_id will send all of its sizes.
   * - file_id is unique for each individual bot and can't be transferred from one bot to another.
   * - file_id uniquely identifies a file, but a file can have different valid file_ids even for the same bot.
   * 
   * Sending by URL
   * - When sending by URL the target file must have the correct MIME type (e.g., audio/mpeg for sendAudio, etc.).
   * - Other configurations may work but we can't guarantee that they will.
   * @param int $Thread Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
   * @param string $Caption Photo caption (may also be used when resending photos by file_id), 0-1024 characters after entities parsing
   * @param TgParseMode $ParseMode Mode for parsing entities in the photo caption. See formatting options for more details.
   * @param TblEntities $Entities A list of special entities that appear in the caption, which can be specified instead of parse_mode
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param TgReplyParams $Reply If the message is a reply, ID of the original message
   * @param TblMarkup $Markup Additional interface options. A object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
   * @param bool $Spoiler If the photo needs to be covered with a spoiler animation
   * @return array Prepared parameters for the PhotoSendMulti method
   * @throws TblException
   * @link https://core.telegram.org/bots/api#sendphoto
   */
  public static function BuildArgs(
    int $Chat,
    string $Photo,
    int $Thread = null,
    string $Caption = null,
    TgParseMode $ParseMode = TgParseMode::Html,
    TblEntities $Entities = null,
    bool $DisableNotification = false,
    bool $Protect = false,
    bool $Spoiler = false,
    TgReplyParams $Reply = null,
    TblMarkup $Markup = null
  ):array{
    if($Caption !== null
    and mb_strlen(strip_tags($Caption)) > TgLimits::Caption):
      throw new TblException(TblError::LimitPhotoCaption);
    endif;
    $param['chat_id'] = $Chat;
    if($Thread !== null):
      $param['message_thread_id'] = $Thread;
    endif;
    if($Caption !== null):
      $param['caption'] = $Caption;
      $param['parse_mode'] = $ParseMode->value;
    endif;
    if($Entities !== null):
      $param['caption_entities'] = $Entities->ToArray();
    endif;
    if($DisableNotification):
      $param['disable_notification'] = 'true';
    endif;
    if($Protect):
      $param['protect_content'] = 'true';
    endif;
    if($Spoiler):
      $param['has_spoiler'] = 'true';
    endif;
    if($Reply !== null):
      $param['reply_to_message_id'] = $Reply->ToArray();
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->ToArray();
    endif;
    if(is_file($Photo)):
      $param['photo'] = new CURLFile($Photo);
    else:
      $param['photo'] = $Photo;
    endif;
    return $param;
  }
}