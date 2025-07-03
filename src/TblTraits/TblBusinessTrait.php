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
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\{
  TgStoryArea,
  TgStoryInputContentPhoto,
  TgStoryInputContentVideo
};
use ProtocolLive\TelegramBotLibrary\TgEnums\{
  TgError,
  TgMethods,
  TgParseMode
};
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgBusinessConnection,
  TgChecklist,
  TgChecklistTask,
  TgGiftsOwned,
  TgLimits,
  TgStarAmount,
  TgStory
};
use ProtocolLive\TelegramBotLibrary\TgParams\TgReplyParams;

/**
 * @version 2025.07.03.03
 */
trait TblBusinessTrait{
  /**
   * Changes the bio of a managed business account. Requires the can_change_bio business bot right.
   * @param string $BusinessId Unique identifier of the business connection
   * @param string|null $Bio The new value of the bio for the business account; 0-140 characters
   * @return true
   * @link https://core.telegram.org/bots/api#setbusinessaccountbio
   */
  public function BusinessBioSet(
    string $BusinessId,
    string|null $Bio = null
  ):true{
    $param['business_connection_id'] = $BusinessId;
    if($Bio !== null
    and $Bio !== ''):
      $param['bio'] = $Bio;
    endif;
    return $this->ServerMethod(TgMethods::BusinessBioSet, $param);
  }

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
   * Use this method to edit a checklist on behalf of a connected business account.
   * @param int $Chat Unique identifier for the target chat
   * @param int $Id Unique identifier for the target message
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message will be sent
   * @param string $Title Title of the checklist; 1-255 characters after entities parsing
   * @param TgChecklistTask[] $Tasks List of 1-30 tasks in the checklist
   * @param bool $TaskAdd If other users can add tasks to the checklist
   * @param bool $TaskDone If other users can mark tasks as done or not done in the checklist
   * @param TgParseMode $ParseMode Mode for parsing entities in the title. See formatting options for more details.
   * @param TblEntities $Entities List of special entities that appear in the title, which can be specified instead of parse_mode. Currently, only bold, italic, underline, strikethrough, spoiler, and custom_emoji entities are allowed.
   * @param TblMarkup|null $Markup A JSON-serialized object for the new inline keyboard for the message
   * @return TgChecklist On success, the edited Message is returned.
   * @link https://core.telegram.org/bots/api#editmessagechecklist
   */
  public function BusinessChecklistEdit(
    int $Chat,
    int $Id,
    string $BusinessId,
    string $Title,
    array $Tasks,
    bool $TaskAdd = false,
    bool $TaskDone = false,
    TgParseMode|null $ParseMode = null,
    TblEntities|null $Entities = null,
    TblMarkup|null $Markup = null
  ):TgChecklist{
    if(mb_strlen($Title) > TgLimits::ChecklistTitle):
      throw new TblException(TgError::LimitChecklistTitle, 'Title length exceeds ' . TgLimits::ChecklistTitle . ' characters');
    endif;
    if(count($Tasks) > TgLimits::ChecklistTasks):
      throw new TblException(TgError::LimitChecklistTasks, 'The number of tasks exceeds ' . TgLimits::ChecklistTasks);
    endif;
    $param['chat_id'] = $Chat;
    $param['business_connection_id'] = $BusinessId;
    $param['message_id'] = $Id;
    $param['checklist']['title'] = $Title;
    foreach($Tasks as &$task):
      $task = $task->ToArray();
    endforeach;
    $param['checklist']['tasks'] = $Tasks;
    if($TaskAdd):
      $param['checklist']['others_can_add_tasks'] = true;
    endif;
    if($TaskDone):
      $param['checklist']['others_can_mark_tasks_as_done'] = true;
    endif;
    if($ParseMode !== null):
      $param['parse_mode'] = $ParseMode->value;
    endif;
    if($Entities !== null):
      $param['title_entities'] = $Entities->ToArray();
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->toArray();
    endif;
    return new TgChecklist($this->ServerMethod(TgMethods::BusinessChecklistEdit, $param));
  }

  /**
   * Use this method to send a checklist on behalf of a connected business account.
   * @param int $Chat Unique identifier for the target chat
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message will be sent
   * @param string $Title Title of the checklist; 1-255 characters after entities parsing
   * @param TgChecklistTask[] $Tasks List of 1-30 tasks in the checklist
   * @param bool $TaskAdd If other users can add tasks to the checklist
   * @param bool $TaskDone If other users can mark tasks as done or not done in the checklist
   * @param TgParseMode|null $ParseMode Mode for parsing entities in the title. See formatting options for more details.
   * @param TblEntities|null $Entities List of special entities that appear in the title, which can be specified instead of parse_mode. Currently, only bold, italic, underline, strikethrough, spoiler, and custom_emoji entities are allowed.
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param string|null $Effect Unique identifier of the message effect to be added to the message
   * @param TgReplyParams|null $Reply A JSON-serialized object for description of the message to reply to
   * @param TblMarkup|null $Markup A JSON-serialized object for an inline keyboard
   * @return TgChecklist On success, the sent Message is returned.
   * @link https://core.telegram.org/bots/api#sendchecklist
   * @link https://core.telegram.org/bots/api#inputchecklist
   */
  public function BusinessChecklistSend(
    int $Chat,
    string $BusinessId,
    string $Title,
    array $Tasks,
    bool $TaskAdd = false,
    bool $TaskDone = false,
    TgParseMode|null $ParseMode = null,
    TblEntities|null $Entities = null,
    bool $DisableNotification = false,
    bool $Protect = false,
    string|null $Effect = null,
    TgReplyParams|null $Reply = null,
    TblMarkup|null $Markup = null
  ):TgChecklist{
    if(mb_strlen($Title) > TgLimits::ChecklistTitle):
      throw new TblException(TgError::LimitChecklistTitle, 'Title length exceeds ' . TgLimits::ChecklistTitle . ' characters');
    endif;
    if(count($Tasks) > TgLimits::ChecklistTasks):
      throw new TblException(TgError::LimitChecklistTasks, 'The number of tasks exceeds ' . TgLimits::ChecklistTasks);
    endif;
    $param['chat_id'] = $Chat;
    $param['business_connection_id'] = $BusinessId;
    $param['checklist']['title'] = $Title;
    foreach($Tasks as &$task):
      $task = $task->ToArray();
    endforeach;
    $param['checklist']['tasks'] = $Tasks;
    if($TaskAdd):
      $param['checklist']['others_can_add_tasks'] = true;
    endif;
    if($TaskDone):
      $param['checklist']['others_can_mark_tasks_as_done'] = true;
    endif;
    if($ParseMode !== null):
      $param['parse_mode'] = $ParseMode->value;
    endif;
    if($Entities !== null):
      $param['title_entities'] = $Entities->ToArray();
    endif;
    if($DisableNotification):
      $param['disable_notification'] = true;
    endif;
    if($Protect):
      $param['protect_content'] = true;
    endif;
    if($Effect !== null):
      $param['message_effect_id'] = $Effect;
    endif;
    if($Reply !== null):
      $param['reply_parameters'] = $Reply->toArray();
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->toArray();
    endif;
    return new TgChecklist($this->ServerMethod(TgMethods::BusinessChecklistSend, $param));
  }

  /**
   * Use this method to get information about the connection of the bot with a business account. Returns a BusinessConnection object on success.
   * @param string $BusinessId Unique identifier for the business account
   * @throws TblException
   * @link https://core.telegram.org/bots/api#getbusinessconnection
   */
  public function BusinessGet(
    string $BusinessId
  ):TgBusinessConnection{
    $param['business_connection_id'] = $BusinessId;
    return new TgBusinessConnection($this->ServerMethod(TgMethods::BusinessGet, $param));
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
   * Transfers an owned unique gift to another user. Requires the can_transfer_and_upgrade_gifts business bot right. Requires can_transfer_stars business bot right if the transfer is paid.
   * @param string $BusinessId Unique identifier of the business connection
   * @param string $Id Unique identifier of the regular gift that should be transferred
   * @param int $Chat Unique identifier of the chat which will own the gift. The chat must be active in the last 24 hours.
   * @param int|null $Stars The amount of Telegram Stars that will be paid for the transfer from the business account balance. If positive, then the can_transfer_stars business bot right is required.
   * @return true
   * @link https://core.telegram.org/bots/api#transfergift
   */
  public function BusinessGiftSend(
    string $BusinessId,
    string $Id,
    int $Chat,
    int|null $Stars = null
  ):true{
    $param['business_connection_id'] = $BusinessId;
    $param['owned_gift_id'] = $Id;
    $param['new_owner_chat_id'] = $Chat;
    if($Stars !== null):
      $param['star_count'] = $Stars;
    endif;
    return $this->ServerMethod(TgMethods::BusinessGiftSend, $param);
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
  public function BusinessGiftsGet(
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
    return new TgGiftsOwned($this->ServerMethod(TgMethods::BusinessGiftsGet, $param));
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
   * Upgrades a given regular gift to a unique gift. Requires the can_transfer_and_upgrade_gifts business bot right. Additionally requires the can_transfer_stars business bot right if the upgrade is paid.
   * @param string $BusinessId Unique identifier of the business connection
   * @param string $Id Unique identifier of the regular gift that should be upgraded to a unique one
   * @param bool $KeepDetails Pass True to keep the original gift text, sender and receiver in the upgraded gift
   * @param int|null $Stars The amount of Telegram Stars that will be paid for the upgrade from the business account balance. If gift.prepaid_upgrade_star_count > 0, then pass 0, otherwise, the can_transfer_stars business bot right is required and gift.upgrade_star_count must be passed.
   * @return true
   * @link https://core.telegram.org/bots/api#upgradegift
   */
  public function BusinessGiftUpgrade(
    string $BusinessId,
    string $Id,
    bool $KeepDetails = false,
    int|null $Stars = null
  ):true{
    $param['business_connection_id'] = $BusinessId;
    $param['owned_gift_id'] = $Id;
    if($KeepDetails):
      $param['keep_original_details'] = $KeepDetails;
    endif;
    if($Stars !== null
    and $Stars >= 0):
      $param['star_count'] = $Stars;
    endif;
    return $this->ServerMethod(TgMethods::BusinessGiftUpgrade, $param);
  }

  /**
   * Changes the first and last name of a managed business account. Requires the can_change_name business bot right.
   * @param string $BusinessId Unique identifier of the business connection
   * @param string $Name The new value of the first name for the business account; 1-64 characters
   * @param string|null $NameLast The new value of the last name for the business account; 0-64 characters
   * @return true
   * @link https://core.telegram.org/bots/api#setbusinessaccountname
   */
  public function BusinessNameSet(
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
    return $this->ServerMethod(TgMethods::BusinessNameSet, $param);
  }

  /**
   * Changes the username of a managed business account. Requires the can_change_username business bot right.
   * @param string $BusinessId Unique identifier of the business connection
   * @param string|null $Nick The new value of the username for the business account; 0-32 characters
   * @return true
   * @link https://core.telegram.org/bots/api#setbusinessaccountusername
   */
  public function BusinessNickSet(
    string $BusinessId,
    string|null $Nick = null
  ):true{
    $param['business_connection_id'] = $BusinessId;
    if($Nick !== null
    and $Nick !== ''):
      $param['username'] = $Nick;
    endif;
    return $this->ServerMethod(TgMethods::BusinessNickSet, $param);
  }

  /**
   * Removes the current profile photo of a managed business account. Requires the can_edit_profile_photo business bot right.
   * @param string $BusinessId Unique identifier of the business connection
   * @param bool $Public Pass True to remove the public photo, which is visible even if the main photo is hidden by the business account's privacy settings. After the main photo is removed, the previous profile photo (if present) becomes the main photo.
   * @return true
   * @link https://core.telegram.org/bots/api#removebusinessaccountprofilephoto
   */
  public function BusinessPhotoDel(
    string $BusinessId,
    bool $Public = true
  ):true{
    $param['business_connection_id'] = $BusinessId;
    $param['public'] = $Public;
    return $this->ServerMethod(TgMethods::BusinessPhotoDel, $param);
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
  public function BusinessPhotoSet(
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
    return $this->ServerMethod(TgMethods::BusinessPhotoSet, $param, false);
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
   * Returns the amount of Telegram Stars owned by a managed business account. Requires the can_view_gifts_and_stars business bot right.
   * @param string $BusinessId Unique identifier of the business connection
   * @return TgStarAmount
   * @link https://core.telegram.org/bots/api#getbusinessaccountstarbalance
   */
  public function BusinessStarsGet(
    string $BusinessId
  ):TgStarAmount{
    $param['business_connection_id'] = $BusinessId;
    return new TgStarAmount($this->ServerMethod(TgMethods::BusinessStarsGet, $param));
  }

  /**
   * Transfers Telegram Stars from the business account balance to the bot's balance. Requires the can_transfer_stars business bot right.
   * @param string $BusinessId Unique identifier of the business connection
   * @param int $Stars Number of Telegram Stars to transfer; 1-10000
   * @return true
   * @link https://core.telegram.org/bots/api#transferbusinessaccountstars
   */
  public function BusinessStarsSend(
    string $BusinessId,
    int $Stars
  ):true{
    $param['business_connection_id'] = $BusinessId;
    $param['star_count'] = $Stars;
    return $this->ServerMethod(TgMethods::BusinessStarsSend, $param);
  }

  /**
   * Deletes a story previously posted by the bot on behalf of a managed business account. Requires the can_manage_stories business bot right.
   * @param string $BusinessId Unique identifier of the business connection
   * @param int $Id Unique identifier of the story to delete
   * @return true Returns True on success.
   * @link https://core.telegram.org/bots/api#deletestory
   */
  public function BusinessStoryDel(
    string $BusinessId,
    int $Id
  ):true{
    $param['business_connection_id'] = $BusinessId;
    $param['story_id'] = $Id;
    return $this->ServerMethod(TgMethods::BusinessStoryDel, $param);
  }

  /**
   * Edits a story previously posted by the bot on behalf of a managed business account. Requires the can_manage_stories business bot right.
   * @param string $BusinessId Unique identifier of the business connection
   * @param int $Id Unique identifier of the story to edit
   * @param TgStoryInputContentPhoto|TgStoryInputContentVideo $Content Content of the story
   * @param string $Caption Caption of the story, 0-2048 characters after entities parsing
   * @param TgParseMode $ParseMode Mode for parsing entities in the story caption. See formatting options for more details.
   * @param TblEntities $Entities List of special entities that appear in story caption, which can be specified instead of parse_mode
   * @param TgStoryArea[] $Areas A JSON-serialized list of clickable areas to be shown on the story
   * @return TgStory Returns Story on success.
   * @link https://core.telegram.org/bots/api#editstory
   */
  public function BusinessStoryEdit(
    string $BusinessId,
    int $Id,
    TgStoryInputContentPhoto|TgStoryInputContentVideo $Content,
    string|null $Caption = null,
    TgParseMode|null $ParseMode = null,
    TblEntities|null $Entities = null,
    array|null $Areas = null
  ):TgStory{
    $param['business_connection_id'] = $BusinessId;
    $param['story_id'] = $Id;
    $param['content'] = $Content->ToArray();
    if(empty($Caption) === false):
      $param['caption'] = $Caption;
    endif;
    if($ParseMode !== null):
      $param['parse_mode'] = $ParseMode->value;
    endif;
    if($Entities !== null):
      $param['caption_entities'] = $Entities->ToArray();
    endif;
    if(empty($Areas) === false):
      foreach($Areas as &$Area):
        $Area = $Area->ToArray();
      endforeach;
      $param['areas'] = $Areas;
    endif;
    return new TgStory($this->ServerMethod(TgMethods::BusinessStoryEdit, $param, false));
  }

  /**
   * Posts a story on behalf of a managed business account. Requires the can_manage_stories business bot right.
   * @param string $BusinessId Unique identifier of the business connection
   * @param TgStoryInputContentPhoto|TgStoryInputContentVideo $Content Content of the story
   * @param int $Period Period after which the story is moved to the archive, in seconds; must be one of 6 * 3600, 12 * 3600, 86400, or 2 * 86400
   * @param string $Caption Caption of the story, 0-2048 characters after entities parsing
   * @param TgParseMode $ParseMode Mode for parsing entities in the story caption. See formatting options for more details.
   * @param TblEntities $Entities A JSON-serialized list of special entities that appear in the caption, which can be specified instead of parse_mode
   * @param TgStoryArea[] $Areas A JSON-serialized list of clickable areas to be shown on the story
   * @param bool $Keep To keep the story accessible after it expires
   * @param bool $Protect If the content of the story must be protected from forwarding and screenshotting
   * @return TgStory Returns Story on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#poststory
   */
  public function BusinessStoryPost(
    string $BusinessId,
    TgStoryInputContentPhoto|TgStoryInputContentVideo $Content,
    int $Period,
    string|null $Caption = null,
    TgParseMode|null $ParseMode = null,
    TblEntities|null $Entities = null,
    array|null $Areas = null,
    bool $Keep = false,
    bool $Protect = false
  ):TgStory{
    $param['business_connection_id'] = $BusinessId;
    $param['content'] = $Content->ToArray();
    $param['active_period'] = $Period;
    if(empty($Caption) === false):
      $param['caption'] = $Caption;
    endif;
    if($ParseMode !== null):
      $param['parse_mode'] = $ParseMode->value;
    endif;
    if($Entities !== null):
      $param['caption_entities'] = $Entities->ToArray();
    endif;
    if(empty($Areas) === false):
      foreach($Areas as &$Area):
        $Area = $Area->ToArray();
      endforeach;
      $param['areas'] = $Areas;
    endif;
    if($Keep):
      $param['post_to_chat_page'] = true;
    endif;
    if($Protect):
      $param['protect_content'] = true;
    endif;
    return new TgStory($this->ServerMethod(TgMethods::BusinessStoryPost, $param, false));
  }
}