<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgParams;
use ProtocolLive\TelegramBotLibrary\TblObjects\{
  TblEntities,
  TblException
};
use ProtocolLive\TelegramBotLibrary\TgEnums\{
  TgError,
  TgParseMode
};
use ProtocolLive\TelegramBotLibrary\TgObjects\TgLimits;

/**
 * @version 2025.08.15.00
 */
class TgReplyParams{
  /**
   * @param int $Message Identifier of the message that will be replied to in the current chat, or in the chat chat_id if it is specified
   * @param int|string $Chat If the message to be replied to is from a different chat, unique identifier for the chat or username of the channel (in the format @channelusername)
   * @param bool $SendWithoutReply Pass True if the message should be sent even if the specified message to be replied to is not found; can be used only for replies in the same chat and forum topic.
   * @param string $Quote Quoted part of the message to be replied to; 0-1024 characters after entities parsing. The quote must be an exact substring of the message to be replied to, including bold, italic, underline, strikethrough, spoiler, and custom_emoji entities. The message will fail to send if the quote isn't found in the original message.
   * @param TgParseMode $ParseMode Mode for parsing entities in the quote. See formatting options for more details.
   * @param TblEntities $Entities A JSON-serialized list of special entities that appear in the quote. It can be specified instead of quote_parse_mode.
   * @param int $Position Position of the quote in the original message in UTF-16 code units
   * @param int $Checklist Identifier of the specific checklist task to be replied to
   * @link https://core.telegram.org/bots/api#replyparameters
   */
  public function __construct(
    public int $Message,
    public int|string|null $Chat = null,
    public bool $SendWithoutReply = false,
    public int|null $Checklist = null,
    public string|null $Quote = null,
    public int|null $Position = null,
    public TgParseMode|null $ParseMode = null,
    public TblEntities|null $Entities = null
  ){
    if($Quote !== null
    and mb_strlen(strip_tags($Quote)) > TgLimits::Quote):
      throw new TblException(
        TgError::LimitQuote,
        'The quote exceeds ' . TgLimits::Quote . ' characters'
      );
    endif;
  }

  public function ToArray():array{
    $return['message_id'] = $this->Message;
    if($this->Chat !== null):
      $return['chat_id'] = $this->Chat;
    endif;
    if($this->Quote !== null):
      $return['quote'] = $this->Quote;
    endif;
    if($this->ParseMode !== null):
      $return['quote_parse_mode'] = $this->ParseMode->value;
    endif;
    if($this->Entities !== null):
      $return['entities'] = $this->Entities->ToArray();
    endif;
    if($this->Position !== null):
      $return['quote_position'] = $this->Position;
    endif;
    if($this->SendWithoutReply):
      $return['allow_sending_without_reply'] = true;
    endif;
    if($this->Checklist !== null):
      $return['checklist_task_id'] = $this->Checklist;
    endif;
    return $return;
  }
}