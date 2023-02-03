<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.02.03.05

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgPermAdmin,
  TgPollType
};

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
   * This object represents one button of the reply keyboard. For simple text buttons, String can be used instead of this object to specify the button text. The optional fields web_app, request_user, request_chat, request_contact, request_location, and request_poll are mutually exclusive.
   * 
   * Note: request_contact and request_location options will only work in Telegram versions released after 9 April, 2016. Older clients will display unsupported message.
   * 
   * Note: request_poll option will only work in Telegram versions released after 23 January, 2020. Older clients will display unsupported message.
   * 
   * Note: web_app option will only work in Telegram versions released after 16 April, 2022. Older clients will display unsupported message.
   * 
   * Note: request_user and request_chat options will only work in Telegram versions released after 3 February, 2023. Older clients will display unsupported message.
   * @param string $Text Label text on the button
   * @param bool $RequestContact If True, the user's phone number will be sent as a contact when the button is pressed. Available in private chats only.
   * @param bool $RequestLocation If True, the user's current location will be sent when the button is pressed. Available in private chats only.
   * @param TgPollType $RequestPoll If specified, the user will be asked to create a poll and send it to the bot when the button is pressed. Available in private chats only.
   * @param string $RequestWebapp If specified, the described Web App will be launched when the button is pressed. The Web App will be able to send a “web_app_data” service message. Available in private chats only.
   * 
   * An HTTPS URL of a Web App to be opened with additional data as specified in Initializing Web Apps
   * @param int $RequestUserId Signed 32-bit identifier of the request
   * @param bool|null $RequestUserBot Pass True to request a bot, pass False to request a regular user. If not specified, no additional restrictions are applied.
   * @param bool|null $RequestUserPremium Pass True to request a premium user, pass False to request a non-premium user. If not specified, no additional restrictions are applied.
   * @param int $RequestChatId Signed 32-bit identifier of the request
   * @param bool $RequestChatChannel Pass True to request a channel chat, pass False to request a group or a supergroup chat.
   * @param bool|null $RequestChatForum Pass True to request a forum supergroup, pass False to request a non-forum chat. If not specified, no additional restrictions are applied.
   * @param bool|null $RequestChatPublic Pass True to request a supergroup or a channel with a username, pass False to request a chat without a username. If not specified, no additional restrictions are applied.
   * @param bool $RequestChatOwner Pass True to request a chat owned by the user. Otherwise, no additional restrictions are applied.
   * @param TgPermAdmin $RequestChatUserPerms A JSON-serialized object listing the required administrator rights of the user in the chat. If not specified, no additional restrictions are applied.
   * @param TgPermAdmin $RequestChatBotPerms A JSON-serialized object listing the required administrator rights of the bot in the chat. The rights must be a subset of user_administrator_rights. If not specified, no additional restrictions are applied.
   * @param bool $RequestChatBotMember Pass True to request a chat with the bot as a member. Otherwise, no additional restrictions are applied.
   * @link https://core.telegram.org/bots/api#inlinekeyboardmarkup
   * @link https://core.telegram.org/bots/api#keyboardbuttonpolltype
   * @link https://core.telegram.org/bots/api#webappinfo
   * @link https://core.telegram.org/bots/api#keyboardbuttonrequestuser
   * @link https://core.telegram.org/bots/api#keyboardbuttonrequestchat
   */
  public function Button(
    int $Line,
    int $Column,
    string $Text,
    bool $RequestContact = false,
    bool $RequestLocation = false,
    TgPollType $RequestPoll = null,
    string $RequestWebapp = null,
    int $RequestUserId = null,
    bool|null $RequestUserBot = null,
    bool|null $RequestUserPremium = null,
    int $RequestChatId = null,
    bool $RequestChatChannel = false,
    bool|null $RequestChatForum = null,
    bool|null $RequestChatPublic = null,
    bool $RequestChatOwner = false,
    TgPermAdmin $RequestChatUserPerms = null,
    TgPermAdmin $RequestChatBotPerms = null,
    bool $RequestChatBotMember = false
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
    if($RequestUserId !== null):
      $this->Pointer[$Line][$Column]['request_user']['request_id'] = $RequestUserId;
      if($RequestUserBot !== null):
        $this->Pointer[$Line][$Column]['request_user']['user_is_bot'] = $RequestUserBot;
      endif;
      if($RequestUserPremium !== null):
        $this->Pointer[$Line][$Column]['request_user']['user_is_premium'] = $RequestUserPremium;
      endif;
    endif;
    if($RequestChatId !== null):
      $this->Pointer[$Line][$Column]['request_chat']['request_id'] = $RequestChatId;
      if($RequestChatChannel):
        $this->Pointer[$Line][$Column]['request_chat']['chat_is_channel'] = true;
      endif;
      if($RequestChatForum !== null):
        $this->Pointer[$Line][$Column]['request_chat']['chat_is_forum'] = $RequestChatForum;
      endif;
      if($RequestChatPublic !== null):
        $this->Pointer[$Line][$Column]['request_chat']['chat_has_username'] = $RequestChatPublic;
      endif;
      if($RequestChatOwner):
        $this->Pointer[$Line][$Column]['request_chat']['chat_is_created'] = true;
      endif;
      if($RequestChatUserPerms !== null):
        $this->Pointer[$Line][$Column]['request_chat']['user_administrator_rights'] = $RequestChatUserPerms->ToArray();
      endif;
      if($RequestChatBotPerms !== null):
        $this->Pointer[$Line][$Column]['request_chat']['bot_administrator_rights'] = $RequestChatBotPerms->ToArray();
      endif;
      if($RequestChatBotMember):
        $this->Pointer[$Line][$Column]['request_chat']['bot_is_member'] = true;
      endif;
    endif;
  }
}