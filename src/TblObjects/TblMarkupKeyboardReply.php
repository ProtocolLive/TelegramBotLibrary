<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgPollType;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgPermAdmin;

  /**
   * This object represents a custom keyboard with reply options (see Introduction to bots for details and examples). Not supported in channels and for messages sent on behalf of a Telegram Business account.
   * @param bool $Persistent Requests clients to always show the keyboard when the regular keyboard is hidden. Defaults to false, in which case the custom keyboard can be hidden and opened with a keyboard icon.
   * @param bool $Resize Requests clients to resize the keyboard vertically for optimal fit (e.g., make the keyboard smaller if there are just two rows of buttons). Defaults to false, in which case the custom keyboard is always of the same height as the app's standard keyboard.
   * @param bool $OneTime Requests clients to hide the keyboard as soon as it's been used. The keyboard will still be available, but clients will automatically display the usual letter-keyboard in the chat - the user can press a special button in the input field to see the custom keyboard again. Defaults to false.
   * @param string $Placeholder The placeholder to be shown in the input field when the keyboard is active; 1-64 characters
   * @param bool $Selective Use this parameter if you want to show the keyboard to specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply to a message in the same chat and forum topic, sender of the original message. Example: A user requests to change the bot's language, bot replies to the request with a keyboard to select the new language. Other users in the group don't see the keyboard.
   * @link https://core.telegram.org/bots/api#replykeyboardmarkup
   * @version 2026.04.05.00
   */
class TblMarkupKeyboardReply
extends TblMarkup{
  public function __construct(
    bool $Persistent = false,
    bool $Resize = false,
    bool $OneTime = false,
    string|null $Placeholder = null,
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
    if(empty($Placeholder) === false):
      $this->Markup['input_field_placeholder'] = $Placeholder;
    endif;
    if($Selective):
      $this->Markup['selective'] = true;
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
  public function RequestChat(
    int $Line,
    int $Column,
    string $Text,
    int $Id,
    bool $Channel = false,
    bool|null $Forum = null,
    bool|null $Public = null,
    bool $Owner = false,
    TgPermAdmin|null $UserPerms = null,
    TgPermAdmin|null $BotPerms = null,
    bool $Member = false
  ):self{
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
    return $this;
  }

  /**
   * The user's phone number will be sent as a contact when the button is pressed. Available in private chats only.
   */
  public function RequestContact(
    int $Line,
    int $Column,
    string $Text
  ):self{
    $this->Pointer[$Line][$Column]['text'] = $Text;
    $this->Pointer[$Line][$Column]['request_contact'] = true;
    return $this;
  }

  /**
   * The user's current location will be sent when the button is pressed. Available in private chats only.
   */
  public function RequestLocation(
    int $Line,
    int $Column,
    string $Text
  ):self{
    $this->Pointer[$Line][$Column]['text'] = $Text;
    $this->Pointer[$Line][$Column]['request_location'] = true;
    return $this;
  }

  /**
   * If specified, pressing the button will ask the user to create and share a bot that will be managed by the current bot. Available for bots that enabled management of other bots in the @BotFather Mini App. Available in private chats only. This object defines the parameters for the creation of a managed bot. Information about the created bot will be shared with the bot using the update managed_bot and a Message with the field managed_bot_created.
   * @param int $Id Signed 32-bit identifier of the request. Must be unique within the message
   * @param string|null $Name Suggested name for the bot
   * @param string|null $Username Suggested username for the bot
   * @link https://core.telegram.org/bots/api#keyboardbuttonrequestmanagedbot
   */
  public function RequestManagedBot(
    int $Line,
    int $Column,
    string $Text,
    int $Id,
    string|null $Name = null,
    string|null $Username = null
  ):self{
    $this->Pointer[$Line][$Column]['text'] = $Text;
    $this->Pointer[$Line][$Column]['request_managed_bot']['request_id'] = $Id;
    if(empty($Name) === false):
      $this->Pointer[$Line][$Column]['request_managed_bot']['suggested_name'] = $Name;
    endif;
    if(empty($Username) === false):
      $this->Pointer[$Line][$Column]['request_managed_bot']['suggested_username'] = $Username;
    endif;
    return $this;
  }

  /**
   * The user will be asked to create a poll and send it to the bot when the button is pressed. Available in private chats only. This object represents type of a poll, which is allowed to be created and sent when the corresponding button is pressed.
   * @param TgPollType $RequestPoll If quiz is passed, the user will be allowed to create only polls in the quiz mode. If regular is passed, only regular polls will be allowed. Otherwise, the user will be allowed to create a poll of any type.
   * @link https://core.telegram.org/bots/api#keyboardbuttonpolltype
   */
  public function RequestPoll(
    int $Line,
    int $Column,
    string $Text,
    TgPollType $RequestPoll
  ):self{
    $this->Pointer[$Line][$Column]['text'] = $Text;
    $this->Pointer[$Line][$Column]['request_poll']['type'] = $RequestPoll->value;
    return $this;
  }

  /**
   *Note: request_users and request_chat options will only work in Telegram versions released after 3 February, 2023. Older clients will display unsupported message.
   * @param string $Text Label text on the button
   * @param int $Id Signed 32-bit identifier of the request
   * @param bool|null $Bot Pass True to request a bot, pass False to request a regular user. If not specified, no additional restrictions are applied.
   * @param bool|null $Premium Pass True to request a premium user, pass False to request a non-premium user. If not specified, no additional restrictions are applied.
   * @link https://core.telegram.org/bots/api#keyboardbuttonrequestusers
   */
  public function RequestUser(
    int $Line,
    int $Column,
    string $Text,
    int|null $Id = null,
    int $Quantity = 1,
    bool|null $Bot = null,
    bool|null $Premium = null
  ):self{
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
    return $this;
  }

  /**
   * The described Web App will be launched when the button is pressed. The Web App will be able to send a “web_app_data” service message. Available in private chats only.
   * @param string|null $RequestWebapp An HTTPS URL of a Web App to be opened with additional data as specified in Initializing Web Apps
   * @link https://core.telegram.org/bots/api#webappinfo
   */
  public function RequestWebApp(
    int $Line,
    int $Column,
    string $Text,
    string|null $RequestWebapp = null
  ):self{
    $this->Pointer[$Line][$Column]['text'] = $Text;
    $this->Pointer[$Line][$Column]['web_app']['url'] = $RequestWebapp;
    return $this;
  }
}