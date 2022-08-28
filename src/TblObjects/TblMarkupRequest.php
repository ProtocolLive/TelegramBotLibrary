<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.19.00

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgPollType;

class TblMarkupRequest extends TblMarkup{
  /**
   * This object represents an inline keyboard that appears right next to the message it belongs to.
   * @param bool $OneTime Requests clients to hide the keyboard as soon as it's been used. The keyboard will still be available, but clients will automatically display the usual letter-keyboard in the chat – the user can press a special button in the input field to see the custom keyboard again. Defaults to false.
   * @param bool Resize Requests clients to resize the keyboard vertically for optimal fit (e.g., make the keyboard smaller if there are just two rows of buttons). Defaults to false, in which case the custom keyboard is always of the same height as the app's standard keyboard.
   * @param string $Placeholder The placeholder to be shown in the input field when the keyboard is active; 1-64 characters
   * @param bool $Selective Use this parameter if you want to show the keyboard to specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message. Example: A user requests to change the bot's language, bot replies to the request with a keyboard to select the new language. Other users in the group don't see the keyboard.
   * @link https://core.telegram.org/bots/api#replykeyboardmarkup
   */
  public function __construct(
    bool $OneTime = false,
    bool $Resize = false,
    string $Placeholder = null,
    bool $Selective = false
  ){
    $this->Markup['keyboard'] = [];
    $this->Pointer = &$this->Markup['keyboard'];
    if($OneTime):
      $this->Pointer['one_time_keyboard'] = 'true';
    endif;
    if($Resize):
      $this->Pointer['resize_keyboard'] = 'true';
    endif;
    if($Placeholder !== null):
      $this->Pointer['input_field_placeholder'] = $Placeholder;
    endif;
    if($Selective === true):
      $this->Pointer['selective'] = 'true';
    endif;
  }

  /**
   * This object represents one button of the reply keyboard. For simple text buttons String can be used instead of this object to specify text of the button. Optional fields request_contact, request_location, and request_poll are mutually exclusive.
   * @param string $Text Text of the button. If none of the optional fields are used, it will be sent as a message when the button is pressed
   * @param bool $Contact If True, the user's phone number will be sent as a contact when the button is pressed. Available in private chats only
   * @param bool $Location If True, the user's current location will be sent when the button is pressed. Available in private chats only
   * @param bool|TgPollType $Poll If specified, the user will be asked to create a poll and send it to the bot when the button is pressed. Available in private chats only. If TgPollType::Quiz is passed, the user will be allowed to create only polls in the quiz mode. If TgPollType::Regular is passed, only regular polls will be allowed. With true, the user will be allowed to create a poll of any type.
   * @link https://core.telegram.org/bots/api#keyboardbutton
   */
  public function Button(
    int $Line,
    int $Column,
    string $Text,
    bool $Contact = false,
    bool $Location = false,
    bool|TgPollType $Poll = null
  ):void{
    $this->Pointer[$Line][$Column]['text'] = $Text;
    if($Contact):
      $this->Pointer[$Line][$Column]['request_contact'] = 'true';
    endif;
    if($Location):
      $this->Pointer[$Line][$Column]['request_location'] = 'true';
    endif;
    if($Poll === true):
      $this->Pointer[$Line][$Column]['request_poll']['type'] = 'null';
    elseif($Poll !== null):
      $this->Pointer[$Line][$Column]['request_poll']['type'] = $Poll->value;
    endif;
  }

  /**
   * The described Web App will be launched when the button is pressed. The Web App will be able to send a “web_app_data” service message. Available in private chats only. This option will only work in Telegram versions released after 16 April, 2022. Older clients will display unsupported message.
   * @param string $Text Text of the button. If none of the optional fields are used, it will be sent as a message when the button is pressed
   * @param string $Url An HTTPS URL of a Web App to be opened with additional data as specified in Initializing Web Apps.
   * @link https://core.telegram.org/bots/api#keyboardbutton
   * @link https://core.telegram.org/bots/api#webappinfo
   */
  public function ButtonWebapp(
    int $Line,
    int $Column,
    string $Text,
    string $Url
  ):void{
    $this->Pointer[$Line][$Column]['text'] = $Text;
    $this->Pointer[$Line][$Column]['web_app']['url'] = $Url;
  }
}