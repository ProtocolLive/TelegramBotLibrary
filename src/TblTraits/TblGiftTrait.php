<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblTraits;
use Exception;
use ProtocolLive\TelegramBotLibrary\TblObjects\{
  TblEntities,
  TblException
};
use ProtocolLive\TelegramBotLibrary\TgEnums\{
  TgMethods,
  TgParseMode
};
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgGifts,
  TgGiftsOwned
};

/**
 * @version 2026.02.09.01
 */
trait TblGiftTrait{
  /**
   * Returns the list of gifts that can be sent by the bot to users and channel chats. Requires no parameters.
   * @link https://core.telegram.org/bots/api#getavailablegifts
   */
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
   * Returns the gifts owned and hosted by a user.
   * @param int $User Unique identifier of the user
   * @param bool $ExcludeUnlimited Pass True to exclude gifts that can be purchased an unlimited number of times
   * @param bool $ExcludeLimitedUpgradable Pass True to exclude gifts that can be purchased a limited number of times and can be upgraded to unique
   * @param bool $ExcludeLimitedNonUpgradable Pass True to exclude gifts that can be purchased a limited number of times and can't be upgraded to unique
   * @param bool $ExcludeBlockchain Pass True to exclude gifts that were assigned from the TON blockchain and can't be resold or transferred in Telegram
   * @param bool $ExcludeUnique Pass True to exclude unique gifts
   * @param bool $SortByPrice Pass True to sort results by gift price instead of send date. Sorting is applied before pagination.
   * @param string $Offset Offset of the first entry to return as received from the previous request; use an empty string to get the first chunk of results
   * @param int $Limit The maximum number of gifts to be returned; 1-100. Defaults to 100
   * @return TgGiftsOwned OwnedGifts on success.
   * @link https://core.telegram.org/bots/api#getusergifts
   */
  public function GiftUserGet(
    int $User,
    bool $ExcludeUnlimited = false,
    bool $ExcludeLimitedUpgradable = false,
    bool $ExcludeLimitedNonUpgradable = false,
    bool $ExcludeBlockchain = false,
    bool $ExcludeUnique = false,
    bool $SortByPrice = false,
    string|null $Offset = null,
    int|null $Limit = null
  ):TgGiftsOwned{
    $param['user_id'] = $User;
    if($ExcludeUnlimited):
      $param['exclude_unlimited'] = true;
    endif;
    if($ExcludeLimitedUpgradable):
      $param['exclude_limited_upgradable'] = true;
    endif;
    if($ExcludeLimitedNonUpgradable):
      $param['exclude_limited_non_upgradable'] = true;
    endif;
    if($ExcludeBlockchain):
      $param['exclude_from_blockchain'] = true;
    endif;
    if($ExcludeUnique):
      $param['exclude_unique'] = true;
    endif;
    if($SortByPrice):
      $param['sort_by_price'] = true;
    endif;
    if(empty($Offset) === false):
      $param['offset'] = $Offset;
    endif;
    if($Limit !== null):
      $param['limit'] = $Limit;
    endif;
    return new TgGiftsOwned($this->ServerMethod(TgMethods::GiftUserGet, $param));
  }

  /**
   * Returns the gifts owned by a chat.
   * @param int $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param bool $ExcludeUnsaved Pass True to exclude gifts that aren't saved to the chat's profile page. Always True, unless the bot has the can_post_messages administrator right in the channel.
   * @param bool $ExcludeSaved Pass True to exclude gifts that are saved to the chat's profile page. Always False, unless the bot has the can_post_messages administrator right in the channel.
   * @param bool $ExcludeUnlimited Pass True to exclude gifts that can be purchased an unlimited number of times
   * @param bool $ExcludeLimitedUpgradable Pass True to exclude gifts that can be purchased a limited number of times and can be upgraded to unique
   * @param bool $ExcludeLimitedNonUpgradable Pass True to exclude gifts that can be purchased a limited number of times and can't be upgraded to unique
   * @param bool $ExcludeBlockchain Pass True to exclude gifts that were assigned from the TON blockchain and can't be resold or transferred in Telegram
   * @param bool $ExcludeUnique Pass True to exclude unique gifts
   * @param bool $SortByPrice Pass True to sort results by gift price instead of send date. Sorting is applied before pagination.
   * @param string $Offset Offset of the first entry to return as received from the previous request; use an empty string to get the first chunk of results
   * @param int $Limit The maximum number of gifts to be returned; 1-100. Defaults to 100
   * @return TgGiftsOwned OwnedGifts on success.
   * @link https://core.telegram.org/bots/api#getchatgifts
   */
  public function GiftChatGet(
    int|string $Chat,
    bool $ExcludeUnsaved = false,
    bool $ExcludeSaved = false,
    bool $ExcludeUnlimited = false,
    bool $ExcludeLimitedUpgradable = false,
    bool $ExcludeLimitedNonUpgradable = false,
    bool $ExcludeBlockchain = false,
    bool $ExcludeUnique = false,
    bool $SortByPrice = false,
    string|null $Offset = null,
    int|null $Limit = null
  ):TgGiftsOwned{
    $param['chat_id'] = $Chat;
    if($ExcludeUnsaved):
      $param['exclude_unsaved'] = true;
    endif;
    if($ExcludeSaved):
      $param['exclude_saved'] = true;
    endif;
    if($ExcludeUnlimited):
      $param['exclude_unlimited'] = true;
    endif;
    if($ExcludeLimitedUpgradable):
      $param['exclude_limited_upgradable'] = true;
    endif;
    if($ExcludeLimitedNonUpgradable):
      $param['exclude_limited_non_upgradable'] = true;
    endif;
    if($ExcludeBlockchain):
      $param['exclude_from_blockchain'] = true;
    endif;
    if($ExcludeUnique):
      $param['exclude_unique'] = true;
    endif;
    if($SortByPrice):
      $param['sort_by_price'] = true;
    endif;
    if(empty($Offset) === false):
      $param['offset'] = $Offset;
    endif;
    if($Limit !== null):
      $param['limit'] = $Limit;
    endif;
    return new TgGiftsOwned($this->ServerMethod(TgMethods::GiftChatGet, $param));
  }
}