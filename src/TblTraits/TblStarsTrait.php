<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblTraits;
use Exception;
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
  TgCaptionable,
  TgChatInviteLink,
  TgGifts,
  TgLimits,
  TgPaidMedia,
  TgStarAmount,
  TgStarTransaction
};
use ProtocolLive\TelegramBotLibrary\TgParams\{
  TgPaidMedias,
  TgReplyParams
};

/**
 * @version 2025.07.04.01
 */
trait TblStarsTrait{
  public function GiftAvailableGet():TgGifts{
    return new TgGifts($this->ServerMethod(TgMethods::GiftAvailableGet));
  }

  /**
   * Gifts a Telegram Premium subscription to the given user.
   * @param int $User Unique identifier of the target user who will receive a Telegram Premium subscription
   * @param int $Months Number of months the Telegram Premium subscription will be active for the user; must be one of 3, 6, or 12
   * @param int $Starts Number of Telegram Stars to pay for the Telegram Premium subscription; must be 1000 for 3 months, 1500 for 6 months, and 2500 for 12 months
   * @param string $Text Text that will be shown along with the service message about the subscription; 0-128 characters
   * @param TgParseMode $ParseMode Mode for parsing entities in the text. See formatting options for more details. Entities other than “bold”, “italic”, “underline”, “strikethrough”, “spoiler”, and “custom_emoji” are ignored.
   * @param TblEntities $Entities A JSON-serialized list of special entities that appear in the gift text. It can be specified instead of text_parse_mode. Entities other than “bold”, “italic”, “underline”, “strikethrough”, “spoiler”, and “custom_emoji” are ignored.
   * @return true Returns True on success.
   * @link https://core.telegram.org/bots/api#giftpremiumsubscription
   * @throws Exception|TblException
   */
  public function GiftPremium(
    int $User,
    int $Months,
    string|null $Text = null,
    TgParseMode|null $ParseMode = null,
    TblEntities|null $Entities = null
  ):true{
    $param['user_id'] = $User;
    if($Months !== 3
    and $Months !== 6
    and $Months !== 12):
      throw new Exception('The number of months must be one of 3, 6, or 12');
    endif;
    $param['month_count'] = $Months;
    if($Months === 3):
      $param['star_count'] = 1000;
    elseif($Months === 6):
      $param['star_count'] = 1500;
    elseif($Months === 12):
      $param['star_count'] = 2500;
    endif;
    if($Text !== null):
      $param['text'] = $Text;
      if($ParseMode !== null):
        $param['text_parse_mode'] = $ParseMode->value;
      endif;
      if($Entities !== null):
        $param['text_entities'] = $Entities->ToArray();
      endif;
    endif;
    return $this->ServerMethod(TgMethods::GiftPremium, $param);
  }

  /**
   * Sends a gift to the given user. The gift can't be converted to Telegram Stars by the user.
   * @param int $User Required if chat_id is not specified. Unique identifier of the target user who will receive the gift.
   * @param int|string $Chat Required if user_id is not specified. Unique identifier for the chat or username of the channel (in the format @channelusername) that will receive the gift.
   * @param string $Gift Identifier of the gift
   * @param string $Text Text that will be shown along with the gift; 0-255 characters
   * @param TgParseMode $ParseMode Mode for parsing entities in the text. See formatting options for more details. Entities other than “bold”, “italic”, “underline”, “strikethrough”, “spoiler”, and “custom_emoji” are ignored.
   * @param TblEntities $Entities A JSON-serialized list of special entities that appear in the gift text. It can be specified instead of text_parse_mode. Entities other than “bold”, “italic”, “underline”, “strikethrough”, “spoiler”, and “custom_emoji” are ignored.
   * @return true Returns True on success.
   */
  public function GiftSend(
    int $User,
    int|string $Chat,
    string $Gift,
    string|null $Text = null,
    TgParseMode|null $ParseMode = null,
    TblEntities|null $Entities = null,
    bool $Upgrade = false
  ):true{
    if($User !== null):
      $param['user_id'] = $User;
    else:
      $param['chat_id'] = $Chat;
    endif;
    $param['gift_id'] = $Gift;
    if($Text !== null):
      $param['text'] = $Text;
    endif;
    if($ParseMode !== null):
      $param['text_parse_mode'] = $ParseMode->value;
    endif;
    if($Entities !== null):
      $param['entities'] = $Entities->ToArray();
    endif;
    if($Upgrade):
      $param['pay_for_upgrade'] = true;
    endif;
    return $this->ServerMethod(TgMethods::GiftSend, $param);
  }

  /**
   * Use this method to create a subscription invite link for a channel chat. The bot must have the can_invite_users administrator rights. The link can be edited using the method editChatSubscriptionInviteLink or revoked using the method revokeChatInviteLink.
   * @param int|string $Chat Unique identifier for the target channel chat or username of the target channel (in the format @channelusername)
   * @param int $SubscriptionPeriod The number of seconds the subscription will be active for before the next payment. Currently, it must always be 2592000 (30 days).
   * @param int $SubscriptionPrice 	The amount of Telegram Stars a user must pay initially and after each subsequent subscription period to be a member of the chat; 1-2500
   * @param string $Name Invite link name; 0-32 characters
   * @return TgChatInviteLink Returns the new invite link as a TgChatInviteLink object.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#createchatsubscriptioninvitelink
   */
  public function InviteLinkStarCreate(
    int|string $Chat,
    int $SubscriptionPeriod,
    int $SubscriptionPrice,
    string|null $Name = null
  ):TgChatInviteLink{
    if($SubscriptionPrice > TgLimits::ChannelSubscriptionPrice):
      throw new TblException(
        TgError::ChannelSubscriptionPrice,
        'Subscription price must be less than ' . TgLimits::ChannelSubscriptionPrice
      );
    endif;
    $param['chat_id'] = $Chat;
    $param['subscription_period'] = $SubscriptionPeriod;
    $param['subscription_price'] = $SubscriptionPrice;
    if($Name !== null):
      if(strlen($Name) > TgLimits::InviteLinkName):
        throw new TblException(
          TgError::InviteLinkName,
          'Invite link name exceeds ' . TgLimits::InviteLinkName . ' characters'
        );
      endif;
      $param['name'] = $Name;
    endif;
    return new TgChatInviteLink($this->ServerMethod(TgMethods::InviteLinkStarCreate, $param));
  }

  /**
   * Use this method to edit a subscription invite link created by the bot. The bot must have the can_invite_users administrator rights.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param string $Link The invite link to edit
   * @param string $Name Invite link name; 0-32 characters
   * @return TgChatInviteLink Returns the edited invite link as a TgChatInviteLink object.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#editchatsubscriptioninvitelink
   */
  public function InviteLinkStarEdit(
    int|string $Chat,
    string $Link,
    string|null $Name = null
  ):TgChatInviteLink{
    $param['chat_id'] = $Chat;
    $param['invite_link'] = $Link;
    if($Name !== null):
      if(strlen($Name) > TgLimits::InviteLinkName):
        throw new TblException(
          TgError::InviteLinkName,
          'Invite link name exceeds ' . TgLimits::InviteLinkName . ' characters'
        );
      endif;
      $param['name'] = $Name;
    endif;
    return new TgChatInviteLink($this->ServerMethod(TgMethods::InviteLinkStarEdit, $param));
  }

  /**
   * Use this method to send paid media to channel chats.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param int $Price The number of Telegram Stars that must be paid to buy access to the media
   * @param TgPaidMedias $Media An object describing the media to be sent; up to 10 items
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message will be sent
   * @param string $Caption Media caption, 0-1024 characters after entities parsing
   * @param bool $CaptionAbove If the caption must be shown above the message media
   * @param TgParseMode $ParseMode Mode for parsing entities in the media caption. See formatting options for more details.
   * @param TblEntities $Entities A list of special entities that appear in the caption, which can be specified instead of parse_mode
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param TgReplyParams $Reply Description of the message to reply to
   * @param TblMarkup $Markup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove a reply keyboard or to force a reply from the user
   * @param string $Payload Bot-defined paid media payload, 0-128 bytes. This will not be displayed to the user, use it for your internal processes.
   * @param bool $AllowPaid Allow up to 1000 messages per second, ignoring broadcasting limits for a fee of 0.1 Telegram Stars per message. The relevant Stars will be withdrawn from the bot's balance
   * @return TgPaidMedia The sent Message is returned.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#sendpaidmedia
   */
  public function MediaPaidSend(
    int|string $Chat,
    int $Price,
    TgPaidMedias $Media,
    string|null $Payload = null,
    string|null $BusinessId = null,
    string|null $Caption = null,
    bool $CaptionAbove = false,
    TgParseMode|null $ParseMode = null,
    TblEntities|null $Entities = null,
    bool $DisableNotification = false,
    bool $Protect = false,
    bool $AllowPaid = false,
    TgReplyParams|null $Reply = null,
    TblMarkup|null $Markup = null
  ):TgPaidMedia{
    $param['chat_id'] = $Chat;
    $param['star_count'] = $Price;
    $param['media'] = $Media->ToArray();
    if(count($param['media']) > TgLimits::MediaGroup):
      throw new TblException(
        TgError::LimitMediaGroup,
        'The maximum number of media items in group is ' . TgLimits::MediaGroup
      );
    endif;
    if(empty($BusinessId) === false):
      $param['business_connection_id'] = $BusinessId;
    endif;
    if(empty($Caption) === false):
      TgCaptionable::CheckLimitCaption($Caption);
      $param['caption'] = $Caption;
      if($ParseMode !== null):
        $param['parse_mode'] = $ParseMode->value;
      endif;
      if($Entities !== null):
        $param['caption_entities'] = $Entities->ToArray();
      endif;
      if($CaptionAbove):
        $param['show_caption_above_media'] = true;
      endif;
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
    if($Payload !== null):
      if(strlen($Payload) > TgLimits::Payload):
        throw new TblException(
          TgError::LimitPayload,
          'The maximum length of the payload is ' . TgLimits::Payload
        );
      endif;
      $param['payload'] = $Payload;
    endif;
    return new TgPaidMedia($this->ServerMethod(TgMethods::PaidMediaSend, $param));
  }

  /**
   * A method to get the current Telegram Stars balance of the bot. Requires no parameters.
   * @return void On success, returns a StarAmount object.
   */
  public function StarBalance():TgStarAmount{
    return new TgStarAmount($this->ServerMethod(TgMethods::StarBalance));
  }

  /**
   * Refunds a successful payment in Telegram Stars.
   * @param int $User Identifier of the user whose payment will be refunded
   * @param string $ChargeId Telegram payment identifier
   * @return true Returns True on success.
   * @throws TblException
   */
  public function StarRefund(
    int $User,
    string $ChargeId
  ):true{
    $param['user_id'] = $User;
    $param['telegram_payment_charge_id'] = $ChargeId;
    return $this->ServerMethod(TgMethods::StarRefund, $param);
  }

  /**
   * Allows the bot to cancel or re-enable extension of a subscription paid in Telegram Stars.
   * @param int $User Identifier of the user whose subscription will be edited
   * @param string $ChargeId Telegram payment identifier for the subscription
   * @param bool $Cancelled Pass True to cancel extension of the user subscription; the subscription must be active up to the end of the current subscription period. Pass False to allow the user to re-enable a subscription that was previously canceled by the bot.
   * @return true Returns True on success.
   * @see TblInvoiceTrait::InvoiceLink
   * @link https://core.telegram.org/bots/api#edituserstarsubscription
   */
  public function StarSubscriptionEdit(
    int $User,
    string $ChargeId,
    bool $Cancelled
  ):true{
    $param['user_id'] = $User;
    $param['telegram_payment_charge_id'] = $ChargeId;
    $param['is_canceled'] = $Cancelled;
    return $this->ServerMethod(TgMethods::StarSubscriptionEdit, $param);
  }

  /**
   * Returns the bot's Telegram Star transactions in chronological order.
   * @return TgStarTransaction[] On success, returns a StarTransactions object.
   * @link https://core.telegram.org/bots/api#getstartransactions
   */
  public function StarTransactionsGet(
    int|null $Offset = null,
    int|null $Limit = null
  ):array{
    if($Offset !== null):
      $param['offset'] = $Offset;
    endif;
    if($Limit !== null):
      $param['limit'] = $Limit;
    endif;
    $return = $this->ServerMethod(TgMethods::StarTransactionsGet, $param ?? null);
    $return = $return['transactions'];
    if($return === []):
      return [];
    endif;
    foreach($return as &$tx):
      $tx = new TgStarTransaction($tx);
    endforeach;
    return $return;
  }
}