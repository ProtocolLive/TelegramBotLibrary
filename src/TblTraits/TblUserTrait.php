<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblTraits;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblException;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgMethods;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgProfilePhoto;

/**
 * @version 2024.11.23.00
 */
trait TblUserTrait{
  /**
   * Use this method to get a list of profile pictures for a user.
   * @param int $User Unique identifier of the target user
   * @param int $Offset Sequential number of the first photo to be returned. By default, all photos are returned.
   * @param int $Limit Limits the number of photos to be retrieved. Values between 1-100 are accepted. Defaults to 100.
   * @return TgProfilePhoto
   * @throws TblException
   * @link https://core.telegram.org/bots/api#getuserprofilephotos
   */
  public function AvatarGet(
    int $User,
    int|null $Offset = null,
    int $Limit = 100
  ):TgProfilePhoto{
    $param['user_id'] = $User;
    if($Offset !== null):
      $param['offset'] = $Offset;
    endif;
    if($Limit > 0 and $Limit < 100):
      $param['limit'] = $Limit;
    endif;
    $return = $this->ServerMethod(TgMethods::UserPhotos, $param);
    return new TgProfilePhoto($return);
  }

  /**
   * Changes the emoji status for a given user that previously allowed the bot to manage their emoji status via the Mini App method requestEmojiStatusAccess.
   * @param int $User Unique identifier of the target user
   * @param string $Emoji Custom emoji identifier of the emoji status to set. Pass an empty string to remove the status.
   * @param int $Expiration Expiration date of the emoji status, if any
   * @return true Returns True on success.
   * @link https://core.telegram.org/bots/api#setuseremojistatus
   */
  public function StatusSet(
    int $User,
    string|null $Emoji = null,
    int|null $Expiration = null
  ):true{
    $param['user_id'] = $User;
    if($Emoji !== null):
      $param['emoji_status_custom_emoji_id'] = $Emoji;
    endif;
    if($Expiration !== null):
      $param['emoji_status_expiration_date'] = $Expiration;
    endif;
    return $this->ServerMethod(TgMethods::StatusSet, $param);
  }
}