<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblTraits;
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
  TgLimits,
  TgPaidMedia,
  TgStarTransaction
};
use ProtocolLive\TelegramBotLibrary\TgParams\{
  TgPaidMedias,
  TgReplyParams
};

/**
 * @version 2024.07.07.00
 */
trait TblStarsTrait{
  /**
   * Use this method to send paid media to channel chats.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param int $Price The number of Telegram Stars that must be paid to buy access to the media
   * @param TgPaidMedias $Media An object describing the media to be sent; up to 10 items
   * @param string $Caption Media caption, 0-1024 characters after entities parsing
   * @param bool $CaptionAbove If the caption must be shown above the message media
   * @param TgParseMode $ParseMode Mode for parsing entities in the media caption. See formatting options for more details.
   * @param TblEntities $Entities A list of special entities that appear in the caption, which can be specified instead of parse_mode
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param TgReplyParams $Reply Description of the message to reply to
   * @param TblMarkup $Markup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove a reply keyboard or to force a reply from the user
   * @return TgPaidMedia The sent Message is returned.
   */
  public function PaidMediaSend(
    int|string $Chat,
    int $Price,
    TgPaidMedias $Media,
    string $Caption = null,
    bool $CaptionAbove = false,
    TgParseMode $ParseMode = null,
    TblEntities $Entities = null,
    bool $DisableNotification = null,
    bool $Protect = null,
    TgReplyParams $Reply = null,
    TblMarkup $Markup = null
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
    if($Caption !== null):
      $param['caption'] = $Caption;
    endif;
    if($CaptionAbove):
      $param['show_caption_above_media'] = true;
    endif;
    if($ParseMode !== null):
      $param['parse_mode'] = $ParseMode->value;
    endif;
    if($Entities !== null):
      $param['caption_entities'] = $Entities->ToArray();
    endif;
    if($DisableNotification !== null):
      $param['disable_notification'] = $DisableNotification;
    endif;
    if($Protect !== null):
      $param['protect_content'] = $Protect;
    endif;
    if($Reply !== null):
      $param['reply_parameters'] = $Reply->ToArray();
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->ToArray();
    endif;
    return new TgPaidMedia($this->ServerMethod(TgMethods::PaidMediaSend, $param));
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
   * Returns the bot's Telegram Star transactions in chronological order.
   * @return TgStarTransaction[] On success, returns a StarTransactions object.
   * @link https://core.telegram.org/bots/api#getstartransactions
   */
  public function StarTransactionsGet(
    int $Offset = null,
    int $Limit = null
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