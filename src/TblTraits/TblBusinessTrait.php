<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblTraits;
use CURLFile;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblException;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgMethods;
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgBusinessConnection,
  TgGiftsOwned,
  TgStarAmount
};

/**
 * @version 2025.04.12.01
 */
trait TblBusinessTrait{
  /**
   * Delete messages on behalf of a business account. Requires the can_delete_outgoing_messages business bot right to delete messages sent by the bot itself, or the can_delete_all_messages business bot right to delete any message.
   * @param string $BusinessId Unique identifier of the business connection on behalf of which to delete the messages
   * @param int[] $Ids A JSON-serialized list of 1-100 identifiers of messages to delete. All messages must be from the same chat. See deleteMessage for limitations on which messages can be deleted
   * @return true
   */
  public function BusinessDel(
    string $BusinessId,
    array $Ids
  ):true{
    $param['business_connection_id'] = $BusinessId;
    $param['message_ids'] = $Ids;
    return $this->ServerMethod(TgMethods::BusinessDel, $param);
  }

  /**
   * Marks incoming message as read on behalf of a business account. Requires the can_read_messages business bot right.
   * @param string $BusinessId Unique identifier of the business connection on behalf of which to read the message
   * @param int $Chat Unique identifier of the chat in which the message was received. The chat must have been active in the last 24 hours.
   * @param int $Id Unique identifier of the message to mark as read
   * @return true
   * @link https://core.telegram.org/bots/api#readbusinessmessage
   */
  public function BusinessRead(
    string $BusinessId,
    int $Chat,
    int $Id
  ):true{
    $param['business_connection_id'] = $BusinessId;
    $param['chat_id'] = $Chat;
    $param['message_id'] = $Id;
    return $this->ServerMethod(TgMethods::BusinessRead, $param);
  }

  /**
   * Removes the current profile photo of a managed business account. Requires the can_edit_profile_photo business bot right.
   * @param string $BusinessId Unique identifier of the business connection
   * @param bool $Public Pass True to remove the public photo, which is visible even if the main photo is hidden by the business account's privacy settings. After the main photo is removed, the previous profile photo (if present) becomes the main photo.
   * @return true
   * @link https://core.telegram.org/bots/api#removebusinessaccountprofilephoto
   */
  public function BusinessDelPhoto(
    string $BusinessId,
    bool $Public = true
  ):true{
    $param['business_connection_id'] = $BusinessId;
    $param['public'] = $Public;
    return $this->ServerMethod(TgMethods::BusinessDelPhoto, $param);
  }

  /**
   * Use this method to get information about the connection of the bot with a business account. Returns a BusinessConnection object on success.
   * @param string $Id Unique identifier for the business account
   * @throws TblException
   * @link https://core.telegram.org/bots/api#getbusinessconnection
   */
  public function BusinessGet(
    string $Id
  ):TgBusinessConnection{
    return new TgBusinessConnection(
      $this->ServerMethod(TgMethods::BusinessGet, ['business_connection_id' => $Id])
    );
  }


  /**
   * Converts a given regular gift to Telegram Stars. Requires the can_convert_gifts_to_stars business bot right.
   * @param string $BusinessId Unique identifier of the business connection
   * @param int $GiftId Unique identifier of the regular gift that should be converted to Telegram Stars
   * @return true
   * @link https://core.telegram.org/bots/api#convertgifttostars
   */
  public function BusinessGiftToStars(
    string $BusinessId,
    int $GiftId
  ):true{
    $param['business_connection_id'] = $BusinessId;
    $param['owned_gift_id'] = $GiftId;
    return $this->ServerMethod(TgMethods::BusinessGiftToStars, $param);
  }

  /**
   * Returns the gifts received and owned by a managed business account. Requires the can_view_gifts_and_stars business bot right.
   * @param string $BusinessId Unique identifier of the business connection
   * @param bool $Unsaved To include gifts that aren't saved to the account's profile page
   * @param bool $Saved To include gifts that are saved to the account's profile page
   * @param bool $Unlimited To include gifts that can be purchased an unlimited number of times
   * @param bool $Limited To include gifts that can be purchased a limited number of times
   * @param bool $Unique To include unique gifts
   * @param bool $SortByPrice To sort results by gift price instead of send date. Sorting is applied before pagination.
   * @param string|null $Offset Offset of the first entry to return as received from the previous request; use empty string to get the first chunk of results
   * @param int $Limit The maximum number of gifts to be returned; 1-100. Defaults to 100
   * @return TgGiftsOwned
   * @link https://core.telegram.org/bots/api#getbusinessaccountgifts
   */
  public function BusinessGetGifts(
    string $BusinessId,
    bool $Unsaved = true,
    bool $Saved = true,
    bool $Unlimited = true,
    bool $Limited = true,
    bool $Unique = true,
    bool $SortByPrice = true,
    string|null $Offset = null,
    int $Limit = 100,
  ):TgGiftsOwned{
    $param['business_connection_id'] = $BusinessId;
    if($Unsaved === false):
      $param['exclude_unsaved'] = true;
    endif;
    if($Saved === false):
      $param['exclude_saved'] = true;
    endif;
    if($Unlimited === false):
      $param['exclude_unlimited'] = true;
    endif;
    if($Limited === false):
      $param['exclude_limited'] = true;
    endif;
    if($Unique === false):
      $param['exclude_unique'] = true;
    endif;
    if($SortByPrice):
      $param['sort_by_price'] = true;
    endif;
    if($Offset !== null):
      $param['offset'] = $Offset;
    endif;
    if($Limit > 0
    and $Limit < 100):
      $param['limit'] = $Limit;
    endif;
    return new TgGiftsOwned($this->ServerMethod(TgMethods::BusinessGetGifts, $param));
  }

  /**
   * Returns the amount of Telegram Stars owned by a managed business account. Requires the can_view_gifts_and_stars business bot right.
   * @param string $BusinessId Unique identifier of the business connection
   * @return TgStarAmount
   * @link https://core.telegram.org/bots/api#getbusinessaccountstarbalance
   */
  public function BusinessGetStars(
    string $BusinessId
  ):TgStarAmount{
    $param['business_connection_id'] = $BusinessId;
    return new TgStarAmount($this->ServerMethod(TgMethods::BusinessGetStars, $param));
  }

  /**
   * Changes the privacy settings pertaining to incoming gifts in a managed business account. Requires the can_change_gift_settings business bot right.
   * @param string $BusinessId Unique identifier of the business connection
   * @param bool $Button If a button for sending a gift to the user or by the business account must always be shown in the input field
   * @param bool $Unlimited If unlimited regular gifts are accepted
   * @param bool $Limited If limited regular gifts are accepted
   * @param bool $Unique If unique gifts or gifts that can be upgraded to unique for free are accepted
   * @param bool $Premium If a Telegram Premium subscription is accepted
   * @return true
   * @link https://core.telegram.org/bots/api#setbusinessaccountgiftsettings
   * @link https://core.telegram.org/bots/api#acceptedgifttypes
   */
  public function BusinessGiftPrivacy(
    string $BusinessId,
    bool $Button,
    bool $Unlimited,
    bool $Limited,
    bool $Unique,
    bool $Premium
  ):true{
    $param['business_connection_id'] = $BusinessId;
    $param['show_gift_button'] = $Button;
    $param['accepted_gift_types']['unlimited_gifts'] = $Unlimited;
    $param['accepted_gift_types']['limited_gifts'] = $Limited;
    $param['accepted_gift_types']['unique_gifts'] = $Unique;
    $param['accepted_gift_types']['premium_subscription'] = $Premium;
    return $this->ServerMethod(TgMethods::BusinessGiftPrivacy, $param);
  }

  /**
   * Changes the bio of a managed business account. Requires the can_change_bio business bot right.
   * @param string $BusinessId Unique identifier of the business connection
   * @param string|null $Bio The new value of the bio for the business account; 0-140 characters
   * @return true
   * @link https://core.telegram.org/bots/api#setbusinessaccountbio
   */
  public function BusinessSetBio(
    string $BusinessId,
    string|null $Bio = null
  ):true{
    $param['business_connection_id'] = $BusinessId;
    if($Bio !== null
    and $Bio !== ''):
      $param['bio'] = $Bio;
    endif;
    return $this->ServerMethod(TgMethods::BusinessSetBio, $param);
  }

  /**
   * Changes the first and last name of a managed business account. Requires the can_change_name business bot right.
   * @param string $BusinessId Unique identifier of the business connection
   * @param string $Name The new value of the first name for the business account; 1-64 characters
   * @param string|null $NameLast The new value of the last name for the business account; 0-64 characters
   * @return true
   * @link https://core.telegram.org/bots/api#setbusinessaccountname
   */
  public function BusinessSetName(
    string $BusinessId,
    string $Name,
    string|null $NameLast = null
  ):true{
    $param['business_connection_id'] = $BusinessId;
    $param['first_name'] = $Name;
    if($NameLast !== null
    and $NameLast !== ''):
      $param['last_name'] = $NameLast;
    endif;
    return $this->ServerMethod(TgMethods::BusinessSetName, $param);
  }

  /**
   * Changes the username of a managed business account. Requires the can_change_username business bot right.
   * @param string $BusinessId Unique identifier of the business connection
   * @param string|null $Nick The new value of the username for the business account; 0-32 characters
   * @return true
   * @link https://core.telegram.org/bots/api#setbusinessaccountusername
   */
  public function BusinessSetNick(
    string $BusinessId,
    string|null $Nick = null
  ):true{
    $param['business_connection_id'] = $BusinessId;
    if($Nick !== null
    and $Nick !== ''):
      $param['username'] = $Nick;
    endif;
    return $this->ServerMethod(TgMethods::BusinessSetNick, $param);
  }

  /**
   * Changes the profile photo of a managed business account. Requires the can_edit_profile_photo business bot right.
   * @param string $BusinessId Unique identifier of the business connection
   * @param string $Photo The new profile photo to set
   * @param bool $Public Pass True to set the public photo, which will be visible even if the main photo is hidden by the business account's privacy settings. An account can have only one public photo.
   * @param bool $Animated A static profile photo in the .JPG format or an animated profile photo in the MPEG4 format.
   * @param int $Static Timestamp in seconds of the frame that will be used as the static profile photo. Defaults to 0.0.
   * @return true
   * @link https://core.telegram.org/bots/api#inputprofilephoto
   */
  public function BusinessSetPhoto(
    string $BusinessId,
    string $Photo,
    bool $Public = true,
    bool $Animated = false,
    int $Static = 0
  ):true{
    $param['business_connection_id'] = $BusinessId;
    if($Animated):
      $param['photo'] = [
        'type' => 'animated',
        'animation' => new CURLFile($Photo),
        'main_frame_timestamp' => $Static
      ];
    else:
      $param['photo'] = [
        'type' => 'static',
        'photo' => new CURLFile($Photo)
      ];
    endif;
    $param['is_public'] = $Public;
    return $this->ServerMethod(TgMethods::BusinessSetPhoto, $param, false);
  }

  /**
   * Transfers Telegram Stars from the business account balance to the bot's balance. Requires the can_transfer_stars business bot right.
   * @param string $BusinessId Unique identifier of the business connection
   * @param int $Stars Number of Telegram Stars to transfer; 1-10000
   * @return true
   * @link https://core.telegram.org/bots/api#transferbusinessaccountstars
   */
  public function BusinessTransfer(
    string $BusinessId,
    int $Stars
  ):true{
    $param['business_connection_id'] = $BusinessId;
    $param['star_count'] = $Stars;
    return $this->ServerMethod(TgMethods::BusinessTransfer, $param);
  }
}