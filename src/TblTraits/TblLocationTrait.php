<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblTraits;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblMarkup;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgMethods;
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgLocation,
  TgVenue
};
use ProtocolLive\TelegramBotLibrary\TgParams\TgReplyParams;

/**
 * @version 2025.07.04.00
 */
trait TblLocationTrait{
  /**
   * Use this method to edit live location messages. A location can be edited until its live_period expires or editing is explicitly disabled by a call to stopMessageLiveLocation.
   * @param string $BussinessId Unique identifier of the business connection on behalf of which the message will be sent
   * @param int|string $Chat Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param int $Id Required if inline_message_id is not specified. Identifier of the message to edit
   * @param string $MessageId Required if chat_id and message_id are not specified. Identifier of the inline message
   * @param float $Latitude Latitude of the location
   * @param float $Longitude Latitude of the location
   * @param int $LivePeriod Period in seconds during which the location will be updated (see Live Locations, should be between 60 and 86400, or 0x7FFFFFFF for live locations that can be edited indefinitely.
   * @param float $HorizontalAccuracy The radius of uncertainty for the location, measured in meters; 0-1500
   * @param int $Heading For live locations, a direction in which the user is moving, in degrees. Must be between 1 and 360 if specified.
   * @param int $ProximityAlertRadius For live locations, a maximum distance for proximity alerts about approaching another chat member, in meters. Must be between 1 and 100000 if specified.
   * @param TblMarkup $Markup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove a reply keyboard or to force a reply from the user
   * @return TgLocation|true On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
   * @link https://core.telegram.org/bots/api#editmessagelivelocation
   */
  public function LocationEdit(
    float $Latitude,
    float $Longitude,
    int|string|null $Chat = null,
    int|null $Id = null,
    string|null $InlineMessageId = null,
    string|null $BussinessId = null,
    int|null $LivePeriod = null,
    float|null $HorizontalAccuracy = null,
    int|null $Heading = null,
    int|null $ProximityAlertRadius = null,
    TblMarkup|null $Markup = null
  ):TgLocation|true{
    $param['chat_id'] = $Chat;
    $param['latitude'] = $Latitude;
    $param['longitude'] = $Longitude;
    if($Chat === null):
      $param['inline_message_id'] = $InlineMessageId;
    else:
      $param['chat_id'] = $Chat;
      $param['message_id'] = $Id;
    endif;
    if($BussinessId !== null):
      $param['business_connection_id'] = $BussinessId;
    endif;
    if($LivePeriod !== null):
      $param['live_period'] = $LivePeriod;
    endif;
    if($HorizontalAccuracy !== null):
      $param['horizontal_accuracy'] = $HorizontalAccuracy;
    endif;
    if($Heading !== null):
      $param['heading'] = $Heading;
    endif;
    if($ProximityAlertRadius !== null):
      $param['proximity_alert_radius'] = $ProximityAlertRadius;
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->ToArray();
    endif;
    $return = $this->SendRequest(TgMethods::LocationEdit, $param);
    if($return === true):
      return true;
    else:
      return new TgLocation($return);
    endif;
  }

  /**
   * Use this method to send point on the map.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param float $Latitude Latitude of the location
   * @param float $Longitude Latitude of the location
   * @param int $Thread Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
   * @param string $BussinessId Unique identifier of the business connection on behalf of which the message will be sent
   * @param float $HorizontalAccuracy The radius of uncertainty for the location, measured in meters; 0-1500
   * @param int $LivePeriod Period in seconds during which the location will be updated (see Live Locations, should be between 60 and 86400, or 0x7FFFFFFF for live locations that can be edited indefinitely.
   * @param int $Heading For live locations, a direction in which the user is moving, in degrees. Must be between 1 and 360 if specified.
   * @param int $ProximityAlertRadius For live locations, a maximum distance for proximity alerts about approaching another chat member, in meters. Must be between 1 and 100000 if specified.
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protected Protects the contents of the sent message from forwarding and saving
   * @param bool $AllowPaid Pass True to allow up to 1000 messages per second, ignoring broadcasting limits for a fee of 0.1 Telegram Stars per message. The relevant Stars will be withdrawn from the bot's balance
   * @param string $Effect Unique identifier of the message effect to be added to the message; for private chats only
   * @param TgReplyParams $Reply Description of the message to reply to
   * @param TblMarkup $Markup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove a reply keyboard or to force a reply from the user
   * @return TgLocation On success, the sent Message is returned.
   * @link https://core.telegram.org/bots/api#sendlocation
   */
  public function LocationSend(
    int|string $Chat,
    float $Latitude,
    float $Longitude,
    int|null $Thread = null,
    string|null $BussinessId = null,
    float|null $HorizontalAccuracy = null,
    int|null $LivePeriod = null,
    int|null $Heading = null,
    int|null $ProximityAlertRadius = null,
    bool $DisableNotification = false,
    bool $Protect = false,
    bool $AllowPaid = false,
    string|null $Effect = null,
    TgReplyParams|null $Reply = null,
    TblMarkup|null $Markup = null
  ):TgLocation{
    $param['chat_id'] = $Chat;
    $param['latitude'] = $Latitude;
    $param['longitude'] = $Longitude;
    if($Thread !== null):
      $param['message_thread_id'] = $Thread;
    endif;
    if($BussinessId !== null):
      $param['business_connection_id'] = $BussinessId;
    endif;
    if($HorizontalAccuracy !== null):
      $param['horizontal_accuracy'] = $HorizontalAccuracy;
    endif;
    if($LivePeriod !== null):
      $param['live_period'] = $LivePeriod;
    endif;
    if($Heading !== null):
      $param['heading'] = $Heading;
    endif;
    if($ProximityAlertRadius !== null):
      $param['proximity_alert_radius'] = $ProximityAlertRadius;
    endif;
    if($DisableNotification):
      $param['disable_notification'] = true;
    endif;
    if($Protect):
      $param['protect_content'] = true;
    endif;
    if($AllowPaid):
      $param['allow_paid'] = true;
    endif;
    if($Effect !== null):
      $param['effect'] = $Effect;
    endif;
    if($Reply !== null):
      $param['reply_parameters'] = $Reply->ToArray();
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->ToArray();
    endif;
    return new TgLocation($this->SendRequest(TgMethods::LocationSend, $param));
  }

  /**
   * Use this method to stop updating a live location message before live_period expires.
   * @param int|string $Chat Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param int $Id Required if inline_message_id is not specified. Identifier of the message with live location to stop
   * @param string $InlineMessageId Required if chat_id and message_id are not specified. Identifier of the inline message
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message to be edited was sent
   * @param TblMarkup $Markup A JSON-serialized object for a new inline keyboard.
   * @return TgLocation|true On success, if the message is not an inline message, the edited Message is returned, otherwise True is returned.
   */
  public function LocationStop(
    int|string|null $Chat = null,
    int|null $Id = null,
    string|null $InlineMessageId = null,
    string|null $BusinessId = null,
    TblMarkup|null $Markup = null
  ):TgLocation|true{
    if($Chat === null):
      $param['inline_message_id'] = $InlineMessageId;
    else:
      $param['chat_id'] = $Chat;
      $param['message_id'] = $Id;
    endif;
    if(empty($BusinessId) === false):
      $param['business_connection_id'] = $BusinessId;
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->ToArray();
    endif;
    $return = $this->SendRequest(TgMethods::LocationStop, $param);
    if($return === true):
      return true;
    else:
      return new TgLocation($return);
    endif;
  }

  /**
   * Use this method to send information about a venue.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param int $Thread Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message will be sent
   * @param float $Latitude Latitude of the venue
   * @param float $Longitude Longitude of the venue
   * @param string $Title Name of the venue
   * @param string $Address Address of the venue
   * @param string $FoursquareId Foursquare identifier of the venue
   * @param string $FoursquareType Foursquare type of the venue, if known. (For example, “arts_entertainment/default”, “arts_entertainment/aquarium” or “food/icecream”.)
   * @param string $GooglePlaceId Google Places identifier of the venue
   * @param string $GooglePlaceType Google Places type of the venue. (See supported types.)
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param bool $AllowPaid Pass True to allow up to 1000 messages per second, ignoring broadcasting limits for a fee of 0.1 Telegram Stars per message. The relevant Stars will be withdrawn from the bot's balance
   * @param string $Effect Unique identifier of the message effect to be added to the message; for private chats only
   * @param TgReplyParams $Reply Description of the message to reply to
   * @param TblMarkup $Markup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove a reply keyboard or to force a reply from the user
   * @return TgVenue On success, the sent Message is returned.
   */
  public function VenueSend(
    int|string $Chat,
    float $Latitude,
    float $Longitude,
    string $Title,
    string $Address,
    int|null $Thread = null,
    string|null $BusinessId = null,
    string|null $FoursquareId = null,
    string|null $FoursquareType = null,
    string|null $GooglePlaceId = null,
    string|null $GooglePlaceType = null,
    bool $DisableNotification = false,
    bool $Protect = false,
    bool $AllowPaid = false,
    string|null $Effect = null,
    TgReplyParams|null $Reply = null,
    TblMarkup|null $Markup = null
  ):TgVenue{
    $param['chat_id'] = $Chat;
    $param['latitude'] = $Latitude;
    $param['longitude'] = $Longitude;
    $param['title'] = $Title;
    $param['address'] = $Address;
    if($Thread !== null):
      $param['message_thread_id'] = $Thread;
    endif;
    if(empty($BusinessId) === false):
      $param['business_connection_id'] = $BusinessId;
    endif;
    if($FoursquareId !== null):
      $param['foursquare_id'] = $FoursquareId;
      $param['foursquare_type'] = $FoursquareType;
    endif;
    if($GooglePlaceId !== null):
      $param['google_place_id'] = $GooglePlaceId;
      $param['google_place_type'] = $GooglePlaceType;
    endif;
    if($DisableNotification):
      $param['disable_notification'] = true;
    endif;
    if($Protect):
      $param['protect_content'] = true;
    endif;
    if($AllowPaid):
      $param['allow_paid'] = true;
    endif;
    if($Effect !== null):
      $param['effect'] = $Effect;
    endif;
    if($Reply !== null):
      $param['reply_parameters'] = $Reply->ToArray();
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->ToArray();
    endif;
    return new TgVenue($this->SendRequest(TgMethods::VenueSend, $param));
  }
}