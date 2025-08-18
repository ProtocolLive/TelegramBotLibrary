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
 * Describes a service message about the rejection of a suggested post.
 * @link https://core.telegram.org/bots/api#suggestedpostdeclined
 * @version 2025.08.18.00
 */
final readonly class TgSuggestedDeclined
implements TgEventInterface,
TgServiceInterface{
  public TgMessageData $Data;
  /**
   * Message containing the suggested post. Note that the Message object in this field will not contain the reply_to_message field even if it itself is a reply.
   */
  public TgMessageInterface|null $Message;
  /**
   * Comment with which the post was declined
   */
  public string|null $Comment;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    if(isset($Data['message'])):
      $this->Message = TblBasics::DetectMessage($Data['message']);
    else:
      $this->Message = null;
    endif;
    $this->Comment = $Data['comment'] ?? null;
  }
}