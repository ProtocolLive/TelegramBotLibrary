<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblTraits;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgMethods;

/**
 * @version 2025.08.17.00
 */
trait TblSuggestionTrait{
  /**
   * Use this method to approve a suggested post in a direct messages chat. The bot must have the 'can_post_messages' administrator right in the corresponding channel chat.
   * @param int $Chat Unique identifier for the target direct messages chat
   * @param int $Id Identifier of a suggested post message to approve
   * @param int|null $SendDate Point in time (Unix timestamp) when the post is expected to be published; omit if the date has already been specified when the suggested post was created. If specified, then the date must be not more than 2678400 seconds (30 days) in the future
   * @return true
   * @link https://core.telegram.org/bots/api#approvesuggestedpost
   */
  public function SuggestionApprove(
    int $Chat,
    int $Id,
    int|null $SendDate = null
  ):true{
    $param['chat_id'] = $Chat;
    $param['message_id'] = $Id;
    if($SendDate !== null):
      $param['send_date'] = $SendDate;
    endif;
    return $this->SendRequest(TgMethods::SuggestionApprove, $param);
  }

  /**
   * Use this method to decline a suggested post in a direct messages chat. The bot must have the 'can_manage_direct_messages' administrator right in the corresponding channel chat.
   * @param int $Chat Unique identifier for the target direct messages chat
   * @param int $Id Identifier of a suggested post message to decline
   * @param int|null $Comment Comment for the creator of the suggested post; 0-128 characters
   * @return true
   * @link https://core.telegram.org/bots/api#declinesuggestedpost
   */
  public function SuggestionDecline(
    int $Chat,
    int $Id,
    int|null $Comment = null
  ):true{
    $param['chat_id'] = $Chat;
    $param['message_id'] = $Id;
    if($Comment !== null):
      $param['comment'] = $Comment;
    endif;
    return $this->SendRequest(TgMethods::SuggestionDecline, $param);
  }
}