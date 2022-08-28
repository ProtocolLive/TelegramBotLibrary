<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.19.00

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgPollType;

class TblMarkupKeyboard extends TblMarkup{
  /**
   * This object represents a custom keyboard with reply options (see Introduction to bots for details and examples).
   * @param bool $Resize Requests clients to resize the keyboard vertically for optimal fit (e.g., make the keyboard smaller if there are just two rows of buttons). Defaults to false, in which case the custom keyboard is always of the same height as the app's standard keyboard.
   * @param bool $OneTime Requests clients to hide the keyboard as soon as it's been used. The keyboard will still be available, but clients will automatically display the usual letter-keyboard in the chat – the user can press a special button in the input field to see the custom keyboard again. Defaults to false.
   * @param string $Placeholder The placeholder to be shown in the input field when the keyboard is active; 1-64 characters
   * @param bool $Selective Use this parameter if you want to show the keyboard to specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
   * Example: A user requests to change the bot's language, bot replies to the request with a keyboard to select the new language. Other users in the group don't see the keyboard.
   * @link https://core.telegram.org/bots/api#replykeyboardmarkup
   */
  public function __construct(
    bool $Resize = false,
    bool $OneTime = false,
    string $Placeholder = null,
    bool $Selective = false
  ){
    $this->Markup['keyboard'] = [];
    $this->Pointer = &$this->Markup['keyboard'];
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
   * @param string $Text Label text on the button
   * @param bool $RequestContact If True, the user's phone number will be sent as a contact when the button is pressed. Available in private chats only.
   * @param bool $RequestLocation If True, the user's current location will be sent when the button is pressed. Available in private chats only.
   * @param TgPollType $RequestPoll If specified, the user will be asked to create a poll and send it to the bot when the button is pressed. Available in private chats only.
   * @param string $RequestWebapp If specified, the described Web App will be launched when the button is pressed. The Web App will be able to send a “web_app_data” service message. Available in private chats only.
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
}