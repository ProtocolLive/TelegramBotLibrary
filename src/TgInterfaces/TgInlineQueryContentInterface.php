<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgInterfaces;

/**
 * This object represents the content of a message to be sent as a result of an inline query. Telegram clients currently support the following 5 types: InputTextMessageContent, InputLocationMessageContent, InputVenueMessageContent, InputContactMessageContent and InputInvoiceMessageContent
 * @link https://core.telegram.org/bots/api#inputmessagecontent
 * @version 2024.01.02.00
 */
interface TgInlineQueryContentInterface{
  public function ToArray();
}