<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblTraits;
use ProtocolLive\TelegramBotLibrary\TblObjects\{
  TblEntities,
  TblException,
  TblMarkup,
  TblMedia
};
use ProtocolLive\TelegramBotLibrary\TgEnums\{
  TgMethods,
  TgParseMode
};
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEditedInterface;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgCaptionable;

/**
 * @version 2025.07.04.00
 */
trait TblEditTrait{
  /**
   * @param string $Caption New caption of the message, 0-1024 characters after entities parsing
   * @param int|string $Chat Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param int $Id Required if inline_message_id is not specified. Identifier of the message to edit
   * @param string $InlineMessageId Required if chat_id and message_id are not specified. Identifier of the inline message
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message to be edited was sent
   * @param bool $CaptionAbove If the caption must be shown above the message media. Supported only for animation, photo and video messages.
   * @param TgParseMode $ParseMode Mode for parsing entities in the message caption. See formatting options for more details.
   * @param TblEntities $Entities A JSON-serialized list of special entities that appear in the caption, which can be specified instead of parse_mode
   * @param TblMarkup $Markup A JSON-serialized object for an inline keyboard.
   * @link https://core.telegram.org/bots/api#editmessagecaption
   */
  public function CaptionEdit(
    string $Caption,
    int|string|null $Chat = null,
    int|null $Id = null,
    string|null $InlineMessageId = null,
    string|null $BusinessId = null,
    bool $CaptionAbove = false,
    TgParseMode|null $ParseMode = null,
    TblEntities|null $Entities = null,
    TblMarkup|null $Markup = null
  ):TgEditedInterface|true{
    TgCaptionable::CheckLimitCaption($Caption);
    $param['caption'] = $Caption;
    if($ParseMode !== null):
      $param['parse_mode'] = $ParseMode->value;
    endif;
    if(empty($InlineMessageId)):
      $param['chat_id'] = $Chat;
      $param['message_id'] = $Id;
    else:
      $param['inline_message_id'] = $InlineMessageId;
    endif;
    if(empty($BusinessId) === false):
      $param['business_connection_id'] = $BusinessId;
    endif;
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
    endif;
    return parent::DetectMessageEdited($return);
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
    int|null $Chat = null,
    int|null $Id = null,
    string|null $IdInline = null,
    string|null $BusinessId = null,
    TblMarkup|null $Markup = null
  ):TgEditedInterface|true{
    if(empty($IdInline)):
      $param['chat_id'] = $Chat;
      $param['message_id'] = $Id;
    else:
      $param['inline_message_id'] = $IdInline;
    endif;
    if(empty($BusinessId) === false):
      $param['business_connection_id'] = $BusinessId;
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
   * Use this method to edit animation, audio, document, photo, or video messages, or to add media to text messages. If a message is part of a message album, then it can be edited only to an audio for audio albums, only to a document for document albums and to a photo or a video otherwise. When an inline message is edited, a new file can't be uploaded; use a previously uploaded file via its file_id or specify a URL. Note that business messages that were not sent by the bot and do not contain an inline keyboard can only be edited within 48 hours from the time they were sent.
   * @param int $Chat Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param int $Id Required if inline_message_id is not specified. Identifier of the message to edit
   * @param string $InlineIdRequired Required if chat_id and message_id are not specified. Identifier of the inline message
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message to be edited was sent
   * @param TblMedia $Media A JSON-serialized object for a new media content of the message
   * @param TblMarkup $Markup A JSON-serialized object for a new inline keyboard.
   * @return TgEditedInterface|true On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#editmessagemedia
   */
  public function MediaEdit(
    TblMedia $Media,
    int|null $Chat = null,
    int|null $Id = null,
    string|null $InlineMessageId = null,
    string|null $BusinessId = null,
    TblMarkup|null $Markup = null
  ):TgEditedInterface|true{
    if(empty($IdInline)):
      $param['chat_id'] = $Chat;
      $param['message_id'] = $Id;
    else:
      $param['inline_message_id'] = $InlineMessageId;
    endif;
    if(empty($BusinessId) === false):
      $param['business_connection_id'] = $BusinessId;
    endif;
    $param['media'] = $Media->ToArray();
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