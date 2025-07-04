<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TblEnums\TblError;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgParseMode;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgLimits;
use ProtocolLive\TelegramBotLibrary\TgParams\TgLinkPreview;

/**
 * @version 2025.07.04.00
 */
final class TblTextEditMulti
extends TblServerMulti{
  /**
   * @param int|string|null $Chat Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param int|null $Id Required if inline_message_id is not specified. Identifier of the message to edit
   * @param string $Text New text of the message, 1-4096 characters after entities parsing
   * @param string|null $InlineMessageId Required if chat_id and message_id are not specified. Identifier of the inline message
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message to be edited was sent
   * @param TgParseMode $ParseMode Mode for parsing entities in the message text.
   * @param TblEntities $Entities A list of special entities that appear in message text, which can be specified instead of parse_mode
   * @param TgLinkPreview $LinkPreview Link preview generation options for the message
   * @param TblMarkup $Markup A object for an inline keyboard.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#editmessagetext
   */
  public function __construct(
    string|null $Text = null,
    int|string|null $Chat = null,
    int|null $Id = null,
    string|null $InlineMessageId = null,
    string|null $BusinessId = null,
    TgParseMode|null $ParseMode = null,
    TblEntities|null $Entities = null,
    TgLinkPreview|null $LinkPreview = null,
    TblMarkup|null $Markup = null,
    int|string|null $MultiControl = null
  ){
    if(empty($Id)
    and empty($InlineMessageId)
    and empty($BusinessId)):
      return;
    endif;
    $this->Args[$MultiControl ?? $Chat] = self::BuildArgs(
      Text: $Text,
      Chat: $Chat,
      Id: $Id,
      InlineMessageId: $InlineMessageId,
      BusinessId: $BusinessId,
      ParseMode: $ParseMode,
      Entities: $Entities,
      LinkPreview: $LinkPreview,
      Markup: $Markup
    );
  }

  /**
   * @param int|string $Chat Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param int $Id Required if inline_message_id is not specified. Identifier of the message to edit
   * @param string $Text New text of the message, 1-4096 characters after entities parsing
   * @param string $InlineMessageId Required if chat_id and message_id are not specified. Identifier of the inline message
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message to be edited was sent
   * @param TgParseMode $ParseMode Mode for parsing entities in the message text.
   * @param TblEntities $Entities A list of special entities that appear in message text, which can be specified instead of parse_mode
   * @param TgLinkPreview $LinkPreview Link preview generation options for the message
   * @param TblMarkup $Markup A object for an inline keyboard.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#editmessagetext
   */
  public function Add(
    string $Text,
    int|string|null $Chat = null,
    int|null $Id = null,
    string|null $InlineMessageId = null,
    string|null $BusinessId = null,
    TgParseMode|null $ParseMode = null,
    TblEntities|null $Entities = null,
    TgLinkPreview|null $LinkPreview = null,
    TblMarkup|null $Markup = null,
    int|string|null $MultiControl = null
  ):void{
    $this->Args[$MultiControl ?? $Chat] = self::BuildArgs(
      Text: $Text,
      Chat: $Chat,
      Id: $Id,
      InlineMessageId: $InlineMessageId,
      BusinessId: $BusinessId,
      ParseMode: $ParseMode,
      Entities: $Entities,
      LinkPreview: $LinkPreview,
      Markup: $Markup
    );
  }

  /**
   * @param int|string|null $Chat Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param int|null $Id Required if inline_message_id is not specified. Identifier of the message to edit
   * @param string $Text New text of the message, 1-4096 characters after entities parsing
   * @param string|null $InlineMessageId Required if chat_id and message_id are not specified. Identifier of the inline message
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message to be edited was sent
   * @param TgParseMode $ParseMode Mode for parsing entities in the message text.
   * @param TblEntities $Entities A list of special entities that appear in message text, which can be specified instead of parse_mode
   * @param TgLinkPreview $LinkPreview Link preview generation options for the message
   * @param TblMarkup $Markup A object for an inline keyboard.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#editmessagetext
   */
  public static function BuildArgs(
    string $Text,
    int|string|null $Chat = null,
    int|null $Id = null,
    string|null $InlineMessageId = null,
    string|null $BusinessId = null,
    TgParseMode|null $ParseMode = null,
    TblEntities|null $Entities = null,
    TgLinkPreview|null $LinkPreview = null,
    TblMarkup|null $Markup = null
  ):array{
    if($Text === null):
      throw new TblException(TblError::MissingParameter, 'Text is required');
    endif;
    if(mb_strlen(strip_tags($Text)) > TgLimits::Text):
      throw new TblException(
        TblError::LimitText,
        'Text must be less than ' . TgLimits::Text . ' characters'
      );
    endif;
    if(empty($InlineMessageId)):
      if(empty($Chat)):
        throw new TblException(TblError::MissingParameter, 'Chat is required');
      endif;
      if(empty($Id)):
        throw new TblException(TblError::MissingParameter, 'Message ID is required');
      endif;
      $param['chat_id'] = $Chat;
      $param['message_id'] = $Id;
    else:
      $param['inline_message_id'] = $InlineMessageId;
    endif;
    $param['text'] = $Text;
    if(empty($BusinessId) === false):
      $param['business_connection_id'] = $BusinessId;
    endif;
    if($ParseMode !== null):
      $param['parse_mode'] = $ParseMode->value;
    endif;
    if($Entities !== null):
      $param['entities'] = $Entities->ToArray();
    endif;
    if($LinkPreview !== null):
      $param['link_preview_options'] = $LinkPreview->ToArray();
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->ToArray();
    endif;
    return $param;
  }
}