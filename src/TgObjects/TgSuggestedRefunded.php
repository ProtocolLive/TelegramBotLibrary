<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblBasics;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgMessageInterface,
  TgServiceInterface
};

/**
 * Describes a service message about a payment refund for a suggested post.
 * @link https://core.telegram.org/bots/api#suggestedpostrefunded
 * @version 2025.08.18.00
 */
final readonly class TgSuggestedRefunded
implements TgEventInterface,
TgServiceInterface{
  public TgMessageData $Data;
  /**
   * Message containing the suggested post. Note that the Message object in this field will not contain the reply_to_message field even if it itself is a reply.
   */
  public TgMessageInterface|null $Message;
  /**
   * Reason for the refund. Currently, one of “post_deleted” if the post was deleted within 24 hours of being posted or removed from scheduled messages without being posted, or “payment_refunded” if the payer refunded their payment.
   */
  public string $Reason;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    if(isset($Data['message'])):
      $this->Message = TblBasics::DetectMessage($Data['message']);
    else:
      $this->Message = null;
    endif;
    $this->Reason = $Data['reason	'];
  }
}