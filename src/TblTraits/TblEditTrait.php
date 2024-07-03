<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblTraits;
use ProtocolLive\TelegramBotLibrary\TblObjects\{
  TblEntities,
  TblError,
  TblException,
  TblMarkup,
  TblMedia
};
use ProtocolLive\TelegramBotLibrary\TgEnums\{
  TgMethods,
  TgParseMode
};
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEditedInterface;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgLimits;

/**
 * @version 2024.07.03.01
 */
trait TblEditTrait{
  /**
   * @param string $Caption New caption of the message, 0-1024 characters after entities parsing
   * @param int|string $Chat Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param int $Id Required if inline_message_id is not specified. Identifier of the message to edit
   * @param string $InlineId Required if chat_id and message_id are not specified. Identifier of the inline message
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message to be edited was sent
   * @param bool $CaptionAbove If the caption must be shown above the message media. Supported only for animation, photo and video messages.
   * @param TgParseMode $ParseMode Mode for parsing entities in the message caption. See formatting options for more details.
   * @param TblEntities $Entities A JSON-serialized list of special entities that appear in the caption, which can be specified instead of parse_mode
   * @param TblMarkup $Markup A JSON-serialized object for an inline keyboard.
   * @link https://core.telegram.org/bots/api#editmessagecaption
   */
  public function CaptionEdit(
    string $Caption,
    int|string $Chat = null,
    int $Id = null,
    string $InlineId = null,
    string $BusinessId = null,
    bool $CaptionAbove = false,
    TgParseMode $ParseMode = null,
    TblEntities $Entities = null,
    TblMarkup $Markup = null
  ):TgEditedInterface|true{
    if(mb_strlen(strip_tags($Caption)) > TgLimits::Caption):
      throw new TblException(TblError::LimitCaption, 'Caption bigger than ' . TgLimits::Caption);
    endif;
    if($InlineId === null
    and $BusinessId === null):
      $param['chat_id'] = $Chat;
      $param['message_id'] = $Id;
    elseif($BusinessId !== null):
      $param['business_connection_id'] = $BusinessId;
    else:
      $param['inline_message_id'] = $InlineId;
    endif;
    $param['caption'] = $Caption;
    $param['parse_mode'] = $ParseMode->value;
    if($Entities !== null):
      $param['caption_entities'] = $Entities->ToArray();
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->ToArray();
    endif;
    if($CaptionAbove):
      $param['show_caption_above_media'] = true;
    endif;
    $return = parent::ServerMethod(TgMethods::CaptionEdit, $param);
    if($return === true):
      return true;
    else:
      return parent::DetectMessageEdited($return);
    endif;
  }

  /**
   * Use this method to edit only the reply markup of messages.
   * @param int $Chat Required if inline_message_id is not specified. Unique identifier for the target chat.
   * @param int $Id Required if inline_message_id is not specified. Identifier of the message to edit
   * @param string $IdInline Required if chat_id and message_id are not specified. Identifier of the inline message
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message to be edited was sent
   * @param TblMarkup $Markup A object for an inline keyboard.
   * @return TgEditedInterface|true On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#editmessagereplymarkup
   */
  public function MarkupEdit(
    int $Chat = null,
    int $Id = null,
    string $IdInline = null,
    string $BusinessId = null,
    TblMarkup $Markup = null
  ):TgEditedInterface|true{
    if($IdInline === null
    and $BusinessId === null):
      $param['chat_id'] = $Chat;
      $param['message_id'] = $Id;
    elseif($BusinessId !== null):
      $param['business_connection_id'] = $BusinessId;
    else:
      $param['inline_message_id'] = $IdInline;
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->ToArray();
    endif;
    $return = $this->ServerMethod(TgMethods::MarkupEdit, $param);
    if($return === true):
      return $return;
    else:
      return parent::DetectMessageEdited($return);
    endif;
  }

  /**
   * Use this method to edit animation, audio, document, photo, or video messages. If a message is part of a message album, then it can be edited only to an audio for audio albums, only to a document for document albums and to a photo or a video otherwise. When an inline message is edited, a new file can't be uploaded; use a previously uploaded file via its file_id or specify a URL.
   * @param int $Chat Required if inline_message_id is not specified. Unique identifier for the target chat
   * @param int $Id Required if inline_message_id is not specified. Identifier of the message to edit
   * @param string $InlineIdRequired if chat_id and message_id are not specified. Identifier of the inline message
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message to be edited was sent
   * @param TblMedia $Media A JSON-serialized object for a new media content of the message
   * @param TblMarkup $Markup A JSON-serialized object for a new inline keyboard.
   * @return TgEditedInterface|true On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#editmessagemedia
   */
  public function MediaEdit(
    int $Chat = null,
    int $Id = null,
    string $InlineId = null,
    string $BusinessId = null,
    TblMedia $Media,
    TblMarkup $Markup = null
  ):TgEditedInterface|true{
    if($InlineId === null
    and $BusinessId === null):
      $param['chat_id'] = $Chat;
      $param['message_id'] = $Id;
    elseif($BusinessId !== null):
      $param['business_connection_id'] = $BusinessId;
    else:
      $param['inline_message_id'] = $InlineId;
    endif;
    $param['media'] = $Media->Get();
    if($Markup !== null):
      $param['reply_markup'] = $Markup->ToArray();
    endif;
    $return = parent::ServerMethod(TgMethods::MediaEdit, $param);
    if($return === true):
      return true;
    else:
      return parent::DetectMessageEdited($return);
    endif;
  }
}