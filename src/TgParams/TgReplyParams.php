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
 * @version 2026.07.18.01
 */
class TgReplyParams{
  /**
   * @param int $Message Identifier of the message that will be replied to in the current chat, or in the chat chat_id if it is specified. Required if ephemeral_message_id isn't specified.
   * @param int|string $Chat If the message to be replied to is from a different chat, unique identifier for the chat or username of the bot, supergroup or channel in the format @username. Not supported for messages sent on behalf of a business account, messages from channel direct messages chats and ephemeral messages.
   * @param bool $SendWithoutReply Pass True if the message should be sent even if the specified message to be replied to is not found. Always False for replies in another chat or forum topic, and sent ephemeral messages. Always True for messages sent on behalf of a business account.
   * @param string $Quote Quoted part of the message to be replied to; 0-1024 characters after entities parsing. The quote must be an exact substring of the message to be replied to, including bold, italic, underline, strikethrough, spoiler, custom_emoji, and date_time entities. The message will fail to send if the quote isn't found in the original message. Ignored for ephemeral messages.
   * @param TgParseMode $ParseMode Mode for parsing entities in the quote. See formatting options for more details.
   * @param TblEntities $Entities A JSON-serialized list of special entities that appear in the quote. It can be specified instead of quote_parse_mode.
   * @param int $Position Position of the quote in the original message in UTF-16 code units
   * @param int $Checklist Identifier of the specific checklist task to be replied to
   * @param string $PollOption Persistent identifier of the specific poll option to be replied to
   * @param int $EphemeralId Identifier of the incoming ephemeral message that will be replied to in the current chat. A reply to an ephemeral message must itself be an ephemeral message. An ephemeral message may only be replied to within 15 seconds of being sent. Required if message_id isn't specified.
   * @link https://core.telegram.org/bots/api#replyparameters
   */
  public function __construct(
    public int|null $Message = null,
    public int|string|null $Chat = null,
    public bool $SendWithoutReply = false,
    public int|null $Checklist = null,
    public string|null $Quote = null,
    public int|null $Position = null,
    public string|null $PollOption = null,
    public TgParseMode|null $ParseMode = null,
    public TblEntities|null $Entities = null,
    public int|null $EphemeralId = null
  ){
    if(empty($Quote) === false
    and mb_strlen(strip_tags($Quote)) > TgLimits::Quote):
      throw new TblException(
        TgError::LimitQuote,
        'The quote exceeds ' . TgLimits::Quote . ' characters'
      );
    endif;
  }

  public function ToArray():array{
    if($this->Message > 0):
      $return['message_id'] = $this->Message;
    endif;
    if(empty($this->Chat) === false):
      $return['chat_id'] = $this->Chat;
    endif;
    if(empty($this->Quote) === false):
      $return['quote'] = $this->Quote;
    endif;
    if($this->ParseMode !== null):
      $return['quote_parse_mode'] = $this->ParseMode->value;
    endif;
    if($this->Entities !== null):
      $return['entities'] = $this->Entities->ToArray();
    endif;
    if($this->Position >= 0):
      $return['quote_position'] = $this->Position;
    endif;
    if($this->SendWithoutReply):
      $return['allow_sending_without_reply'] = true;
    endif;
    if($this->Checklist > 0):
      $return['checklist_task_id'] = $this->Checklist;
    endif;
    if(empty($this->PollOption) === false):
      $return['poll_option_id'] = $this->PollOption;
    endif;
    if($this->EphemeralId > 0):
      $return['ephemeral_message_id'] = $this->EphemeralId;
    endif;
    return $return;
  }
}