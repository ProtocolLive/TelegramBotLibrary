<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgError;

/**
 * @version 2024.01.03.00
 */
abstract class TgErrors{
  public static function Search(string $Description):TgError|false{
    if(str_starts_with($Description, 'Bad Request: menu button web app URL ')
    and str_ends_with($Description, ' is invalid: Only HTTPS links are allowed')):
      return TgError::WebAppHttps;
    endif;
    if(str_starts_with($Description, 'Bad Request: can\'t parse entities: Unsupported start tag ')):
      return TgError::Html;
    endif;
    if(str_starts_with($Description, 'Too Many Requests: retry after ')):
      return TgError::TooMany;
    endif;
    if(str_starts_with($Description, 'Bad Request: entity beginning at UTF-16 offset ')
    and str_contains($Description, 'ends after the end of the text at UTF-16 offset ')):
      return TgError::EntityParse;
    endif;
    if(str_starts_with($Description, 'Bad Request: file "')
    and str_ends_with($Description, ' bytes is too big for a video note')):
      return TgError::TooBig;
    endif;
    if(str_starts_with($Description, 'Bad Request: can\'t parse entities: Character')
    and str_ends_with($Description, 'is reserved and must be escaped with the preceding \'\\\'')):
      return TgError::Markdown;
    endif;

    return match($Description){
      'Bad Request: BUTTON_ID_INVALID' => TgError::ButtonIdInvalid,
      'Bad Request: BOT_SCORE_NOT_MODIFIED' => TgError::GameScore,
      'Bad Request: can\'t parse ChatAdministratorRights: Field "can_manage_chat" must be of type Boolean' => TgError::PermAdminManage,
      'Bad Request: can\'t parse inline keyboard button: Text buttons are unallowed in the inline keyboard' => TgError::TextButtonNo,
      'Bad Request: can\'t parse inline query result: Can\'t find field "message_text"' => TgError::InlineQueryMessage,
      'Bad Request: can\'t parse inline query result: Can\'t find field "thumb_url"' => TgError::InlineQueryThumbMiss,
      'Bad Request: can\'t parse inline query result: Field \"thumb_url\" must be of type String' => TgError::InlineQueryThumbType,
      'Bad Request: can\'t parse inline query result: Inline query result must be an object' => TgError::InlineQueryResult,
      'Bad Request: can\'t parse JSON encoded inline query results: Closing \'"\' not found' => TgError::InlineQueryClosing,
      'Bad Request: can\'t parse JSON encoded inline query results: Expected string end' => TgError::InlineQueryStringEnd,
      'Bad Request: can\'t parse keyboard button: ChatAdministratorRights must be an Object' => TgError::ChatAdministratorRightsObject,
      'Bad Request: can\'t parse labeled price: Can\'t find field "label"' => TgError::InvoiceLabel,
      'Bad Request: can\'t parse MessageEntity: Field "user" must be of type Object' => TgError::UserObject,
      'Bad Request: chat not found' => TgError::ChatNotFound,
      'Bad Request: CURRENCY_TOTAL_AMOUNT_INVALID' => TgError::InvoiceLimits,
      'Bad Request: failed to get HTTP URL content' => TgError::UrlFailed,
      'Bad Request: inline keyboard expected' => TgError::InlineKeyboardNone,
      'Bad Request: invalid inline message identifier specified' => TgError::InlineId,
      'Bad Request: message can\'t be deleted for everyone' => TgError::CantDelete,
      'Bad Request: message has protected content and can\'t be forwarded' => TgError::Protected,
      'Bad Request: message is not modified: specified new message content and reply markup are exactly the same as a current content and reply markup of the message' => TgError::EditSame,
      'Bad Request: message to copy not found' => TgError::CopyNotFound,
      'Bad Request: message to edit not found' => TgError::EditNotFound,
      'Bad Request: message to unpin not found' => TgError::UnpinNotFound,
      'Bad Request: MESSAGE_ID_INVALID' => TgError::MessageIdInvalid,
      'Bad Request: object expected as link preview options' => TgError::LinkPreview,
      'Bad Request: PHOTO_THUMB_URL_EMPTY' => TgError::InlineQueryThumbEmpty,
      'Bad Request: query is too old and response timeout expired or query ID is invalid' => TgError::CallbackQueryOld,
      'Bad Request: QUOTE_TEXT_INVALID' => TgError::Quote,
      'Bad Request: the message can\'t be forwarded' => TgError::ForwardCant,
      'Bad Request: there is no media in the message to edit' => TgError::NoMedia,
      'Bad Request: there must be at least one price' => TgError::SomethingMissing,
      'Bad Request: user is an administrator of the chat' => TgError::Admin,
      'Bad Request: user not found' => TgError::UserNotFound,
      'Bad Request: VOICE_MESSAGES_FORBIDDEN' => TgError::ForwardCant,
      'Bad Request: WEBDOCUMENT_URL_INVALID' => TgError::UrlInvalid,
      'Bad Request: wrong file identifier/HTTP URL specified' => TgError::FileId,
      'Bad Request: wrong remote file identifier specified: Wrong string length' => TgError::UrlShort,
      'Forbidden: bot can\'t send messages to bots' => TgError::BotBot,
      'Forbidden: bot is not a member of the channel chat' => TgError::NotMember,
      'Forbidden: bot was blocked by the user' => TgError::Blocked,
      'Forbidden: bot was kicked from the supergroup chat' => TgError::Banned,
      'Forbidden: user is deactivated' => TgError::Deleted,
      default => false
    };
  }
}