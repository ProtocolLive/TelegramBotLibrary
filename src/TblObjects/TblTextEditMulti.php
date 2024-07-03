<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgParseMode;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgLimits;
use ProtocolLive\TelegramBotLibrary\TgParams\TgLinkPreview;

/**
 * @version 2024.07.03.00
 */
final class TblTextEditMulti
extends TblServerMulti{
  /**
   * @param int|string|null $Chat Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param int|null $Id Required if inline_message_id is not specified. Identifier of the message to edit
   * @param string $Text New text of the message, 1-4096 characters after entities parsing
   * @param string|null $InlineId Required if chat_id and message_id are not specified. Identifier of the inline message
   * @param TgParseMode $ParseMode Mode for parsing entities in the message text.
   * @param TblEntities $Entities A list of special entities that appear in message text, which can be specified instead of parse_mode
   * @param TgLinkPreview $LinkPreview Link preview generation options for the message
   * @param TblMarkup $Markup A object for an inline keyboard.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#editmessagetext
   */
  public function __construct(
    int|string $Chat = null,
    int $Id = null,
    string $Text,
    string $InlineId = null,
    TgParseMode $ParseMode = null,
    TblEntities $Entities = null,
    TgLinkPreview $LinkPreview = null,
    TblMarkup $Markup = null,
    int|string $MultiControl = null
  ){
    if($Id === null and $InlineId === null):
      return;
    endif;
    $this->Args[$MultiControl ?? $Chat] = self::BuildArgs(
      $Chat,
      $Id,
      $Text,
      $InlineId,
      $ParseMode,
      $Entities,
      $LinkPreview,
      $Markup
    );
  }

  /**
   * @param int|string $Chat Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param int $Id Required if inline_message_id is not specified. Identifier of the message to edit
   * @param string $Text New text of the message, 1-4096 characters after entities parsing
   * @param string $InlineId Required if chat_id and message_id are not specified. Identifier of the inline message
   * @param TgParseMode $ParseMode Mode for parsing entities in the message text.
   * @param TblEntities $Entities A list of special entities that appear in message text, which can be specified instead of parse_mode
   * @param TgLinkPreview $LinkPreview Link preview generation options for the message
   * @param TblMarkup $Markup A object for an inline keyboard.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#editmessagetext
   */
  public function Add(
    int|string $Chat = null,
    int $Id = null,
    string $Text,
    string $InlineId = null,
    TgParseMode $ParseMode = null,
    TblEntities $Entities = null,
    TgLinkPreview $LinkPreview = null,
    TblMarkup $Markup = null,
    int|string $MultiControl = null
  ):void{
    $this->Args[$MultiControl ?? $Chat] = self::BuildArgs(
      $Chat,
      $Id,
      $Text,
      $InlineId,
      $ParseMode,
      $Entities,
      $LinkPreview,
      $Markup
    );
  }

  /**
   * @param int|string|null $Chat Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param int|null $Id Required if inline_message_id is not specified. Identifier of the message to edit
   * @param string $Text New text of the message, 1-4096 characters after entities parsing
   * @param string|null $InlineId Required if chat_id and message_id are not specified. Identifier of the inline message
   * @param TgParseMode $ParseMode Mode for parsing entities in the message text.
   * @param TblEntities $Entities A list of special entities that appear in message text, which can be specified instead of parse_mode
   * @param TgLinkPreview $LinkPreview Link preview generation options for the message
   * @param TblMarkup $Markup A object for an inline keyboard.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#editmessagetext
   */
  public static function BuildArgs(
    string $Text,
    int|string $Chat = null,
    int $Id = null,
    string $InlineId = null,
    TgParseMode $ParseMode = null,
    TblEntities $Entities = null,
    TgLinkPreview $LinkPreview = null,
    TblMarkup $Markup = null
  ):array{
    if($InlineId === null):
      if($Chat === null):
        throw new TblException(TblError::MissingParameter, 'Chat is required');
      endif;
      if($Id === null):
        throw new TblException(TblError::MissingParameter, 'Message ID is required');
      endif;
      $param['chat_id'] = $Chat;
      $param['message_id'] = $Id;
    else:
      $param['inline_message_id'] = $InlineId;
    endif;
    if($Text === null):
      throw new TblException(TblError::MissingParameter, 'Text is required');
    endif;
    if(mb_strlen($Text) > TgLimits::Text):
      throw new TblException(TblError::LimitText);
    endif;
    $param['text'] = $Text;
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