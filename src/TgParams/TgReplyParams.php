<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgParams;
use ProtocolLive\TelegramBotLibrary\TblObjects\{
  TblEntities,
  TblError,
  TblException
};
use ProtocolLive\TelegramBotLibrary\TgEnums\TgParseMode;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgLimits;

/**
 * @link https://core.telegram.org/bots/api#replyparameters
 * @version 2024.11.23.00
 */
class TgReplyParams{
  private array $Array = [];

  /**
   * @param int $Message Identifier of the message that will be replied to in the current chat, or in the chat chat_id if it is specified
   * @param int|string $Chat If the message to be replied to is from a different chat, unique identifier for the chat or username of the channel (in the format @channelusername)
   * @param bool $SendWithouReply Pass True if the message should be sent even if the specified message to be replied to is not found; can be used only for replies in the same chat and forum topic.
   * @param string $Quote Quoted part of the message to be replied to; 0-1024 characters after entities parsing. The quote must be an exact substring of the message to be replied to, including bold, italic, underline, strikethrough, spoiler, and custom_emoji entities. The message will fail to send if the quote isn't found in the original message.
   * @param TgParseMode $ParseMode Mode for parsing entities in the quote. See formatting options for more details.
   * @param TblEntities $Entities A JSON-serialized list of special entities that appear in the quote. It can be specified instead of quote_parse_mode.
   * @param int $Position Position of the quote in the original message in UTF-16 code units
   */
  public function __construct(
    int $Message,
    int|string|null $Chat = null,
    bool $SendWithouReply = false,
    string|null $Quote = null,
    int|null $Position = null,
    TgParseMode|null $ParseMode = null,
    TblEntities|null $Entities = null
  ){
    $this->Array['message_id'] = $Message;
    if($Chat !== null):
      $this->Array['chat_id'] = $Chat;
    endif;
    if($SendWithouReply):
      $this->Array['allow_sending_without_reply'] = true;
    endif;
    if($Quote !== null):
      if(mb_strlen($Quote) > TgLimits::Quote):
        throw new TblException(TblError::Quote, 'Quote is too long');
      endif;
      $this->Array['quote'] = $Quote;
    endif;
    if($ParseMode !== null):
      $this->Array['quote_parse_mode'] = $ParseMode->value;
    endif;
    if($Entities !== null):
      $this->Array['entities'] = $Entities->ToArray();
    endif;
    if($Position !== null):
      $this->Array['quote_position'] = $Position;
    endif;
  }

  public function ToArray():array{
    return $this->Array;
  }
}