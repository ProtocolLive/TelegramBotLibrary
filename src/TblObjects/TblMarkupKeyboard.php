<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgPermAdmin,
  TgPollType
};

/**
 * @version 2023.12.29.00
 */
class TblMarkupKeyboard
extends TblMarkup{
  /**
   * This object represents a custom keyboard with reply options (see Introduction to bots for details and examples).
   * @param bool $Persistent Requests clients to always show the keyboard when the regular keyboard is hidden. Defaults to false, in which case the custom keyboard can be hidden and opened with a keyboard icon.
   * @param bool $Resize Requests clients to resize the keyboard vertically for optimal fit (e.g., make the keyboard smaller if there are just two rows of buttons). Defaults to false, in which case the custom keyboard is always of the same height as the app's standard keyboard.
   * @param bool $OneTime Requests clients to hide the keyboard as soon as it's been used. The keyboard will still be available, but clients will automatically display the usual letter-keyboard in the chat – the user can press a special button in the input field to see the custom keyboard again. Defaults to false.
   * @param string $Placeholder The placeholder to be shown in the input field when the keyboard is active; 1-64 characters
   * @param bool $Selective Use this parameter if you want to show the keyboard to specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
   * Example: A user requests to change the bot's language, bot replies to the request with a keyboard to select the new language. Other users in the group don't see the keyboard.
   * @link https://core.telegram.org/bots/api#replykeyboardmarkup
   */
  public function __construct(
    bool $Persistent = false,
    bool $Resize = false,
    bool $OneTime = false,
    string $Placeholder = null,
    bool $Selective = false
  ){
    $this->Markup['keyboard'] = [];
    $this->Pointer = &$this->Markup['keyboard'];
    if($Persistent):
      $this->Markup['is_persistent'] = true;
    endif;
    if($Resize):
      $this->Markup['resize_keyboard'] = true;
    endif;
    if($OneTime):
      $this->Markup['one_time_keyboard'] = true;
    endif;
    if($Placeholder !== null):
      $this->Markup['input_field_placeholder'] = $Placeholder;
    endif;
    if($Selective):
      $this->Markup['selective'] = true;
    endif;
  }

  /**
   * This object represents one button of the reply keyboard. For simple text buttons, String can be used instead of this object to specify the button text. The optional fields web_app, request_users, request_chat, request_contact, request_location, and request_poll are mutually exclusive.
   * 
   * Note: request_contact and request_location options will only work in Telegram versions released after 9 April, 2016. Older clients will display unsupported message.
   * 
   * Note: request_poll option will only work in Telegram versions released after 23 January, 2020. Older clients will display unsupported message.
   * 
   * Note: web_app option will only work in Telegram versions released after 16 April, 2022. Older clients will display unsupported message.
   * 
   * @param string $Text Label text on the button
   * @param bool $RequestContact If True, the user's phone number will be sent as a contact when the button is pressed. Available in private chats only.
   * @param bool $RequestLocation If True, the user's current location will be sent when the button is pressed. Available in private chats only.
   * @param TgPollType $RequestPoll If specified, the user will be asked to create a poll and send it to the bot when the button is pressed. Available in private chats only.
   * @param string $RequestWebapp If specified, the described Web App will be launched when the button is pressed. The Web App will be able to send a “web_app_data” service message. Available in private chats only.
   * 
   * An HTTPS URL of a Web App to be opened with additional data as specified in Initializing Web Apps
   * @link https://core.telegram.org/bots/api#inlinekeyboardmarkup
   * @link https://core.telegram.org/bots/api#keyboardbuttonpolltype
   * @link https://core.telegram.org/bots/api#webappinfo
   */
  public function Button(
    int $Line,
    int $Column,
    string $Text,
    bool $RequestContact = false,
    bool $RequestLocation = false,
    TgPollType $RequestPoll = null,
    string $RequestWebapp = null
  ):void{
    $this->Pointer[$Line][$Column]['text'] = $Text;
    if($RequestContact):
      $this->Pointer[$Line][$Column]['request_contact'] = true;
    endif;
    if($RequestLocation):
      $this->Pointer[$Line][$Column]['request_location'] = true;
    endif;
    if($RequestPoll != null):
      $this->Pointer[$Line][$Column]['request_poll']['type'] = $RequestPoll->value;
    endif;
    if($RequestWebapp != null):
      $this->Pointer[$Line][$Column]['web_app']['url'] = $RequestWebapp;
    endif;
  }

  /**
   * Note: request_users and request_chat options will only work in Telegram versions released after 3 February, 2023. Older clients will display unsupported message.
   * @param string $Text Label text on the button
   * @param int $Id Signed 32-bit identifier of the request
   * @param bool $Channel Pass True to request a channel chat, pass False to request a group or a supergroup chat.
   * @param bool|null $Forum Pass True to request a forum supergroup, pass False to request a non-forum chat. If not specified, no additional restrictions are applied.
   * @param bool|null $Public Pass True to request a supergroup or a channel with a username, pass False to request a chat without a username. If not specified, no additional restrictions are applied.
   * @param bool $Owner Pass True to request a chat owned by the user. Otherwise, no additional restrictions are applied.
   * @param TgPermAdmin $UserPerms A JSON-serialized object listing the required administrator rights of the user in the chat. If not specified, no additional restrictions are applied.
   * @param TgPermAdmin $BotPerms A JSON-serialized object listing the required administrator rights of the bot in the chat. The rights must be a subset of user_administrator_rights. If not specified, no additional restrictions are applied.
   * @param bool $Member Pass True to request a chat with the bot as a member. Otherwise, no additional restrictions are applied.
   * @link https://core.telegram.org/bots/api#keyboardbuttonrequestchat
   */
  public function ButtonRequestChat(
    int $Line,
    int $Column,
    string $Text,
    int $Id,
    bool $Channel = false,
    bool|null $Forum = null,
    bool|null $Public = null,
    bool $Owner = false,
    TgPermAdmin $UserPerms = null,
    TgPermAdmin $BotPerms = null,
    bool $Member = false
  ):void{
    $this->Pointer[$Line][$Column]['text'] = $Text;
    $this->Pointer[$Line][$Column]['request_chat']['request_id'] = $Id;
    if($Channel):
      $this->Pointer[$Line][$Column]['request_chat']['chat_is_channel'] = true;
    endif;
    if($Forum !== null):
      $this->Pointer[$Line][$Column]['request_chat']['chat_is_forum'] = $Forum;
    endif;
    if($Public !== null):
      $this->Pointer[$Line][$Column]['request_chat']['chat_has_username'] = $Public;
    endif;
    if($Owner):
      $this->Pointer[$Line][$Column]['request_chat']['chat_is_created'] = true;
    endif;
    if($UserPerms !== null):
      $this->Pointer[$Line][$Column]['request_chat']['user_administrator_rights'] = $UserPerms->ToArray();
    endif;
    if($BotPerms !== null):
      $this->Pointer[$Line][$Column]['request_chat']['bot_administrator_rights'] = $BotPerms->ToArray();
    endif;
    if($Member):
      $this->Pointer[$Line][$Column]['request_chat']['bot_is_member'] = true;
    endif;
  }

  /**
   *Note: request_users and request_chat options will only work in Telegram versions released after 3 February, 2023. Older clients will display unsupported message.
   * @param int $Line
   * @param int $Column
   * @param string $Text Label text on the button
   * @param int $Id Signed 32-bit identifier of the request
   * @param bool|null $Bot Pass True to request a bot, pass False to request a regular user. If not specified, no additional restrictions are applied.
   * @param bool|null $Premium Pass True to request a premium user, pass False to request a non-premium user. If not specified, no additional restrictions are applied.
   * @link https://core.telegram.org/bots/api#keyboardbuttonrequestusers
   */
  public function ButtonRequestUser(
    int $Line,
    int $Column,
    string $Text,
    int $Id = null,
    int $Quantity = 1,
    bool|null $Bot = null,
    bool|null $Premium = null
  ):void{
    $this->Pointer[$Line][$Column]['text'] = $Text;
    $this->Pointer[$Line][$Column]['request_users']['request_id'] = $Id;
    if($Bot !== null):
      $this->Pointer[$Line][$Column]['request_users']['user_is_bot'] = $Bot;
    endif;
    if($Premium !== null):
      $this->Pointer[$Line][$Column]['request_users']['user_is_premium'] = $Premium;
    endif;
    if($Quantity > 1):
      $this->Pointer[$Line][$Column]['request_users']['max_quantity'] = $Quantity;
    endif;
  }
}