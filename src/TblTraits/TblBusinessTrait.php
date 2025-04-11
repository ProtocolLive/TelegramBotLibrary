<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblTraits;
use CURLFile;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblException;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgMethods;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgBusinessConnection;

/**
 * @version 2025.04.11.01
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
}