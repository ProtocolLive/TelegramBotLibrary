<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.05.30.00
//API 6.0

abstract class TblMarkup{
  protected array $Markup;
  protected array $Pointer;

  /**
   * Get the markup object in json format
   */
  public function ToJson():string{
    return json_encode($this->Markup);
  }

  public function ButtonGet(
    int $Line,
    int $Col
  ):array{
    return $this->Pointer[$Line][$Col];
  }
}

class TblMarkupInline extends TblMarkup{
  /**
   * This object represents an inline keyboard that appears right next to the message it belongs to.
   * @link https://core.telegram.org/bots/api#inlinekeyboardmarkup
   */
  public function __construct(){
    $this->Markup['inline_keyboard'] = [];
    $this->Pointer = &$this->Markup['inline_keyboard'];
  }

  /**
   * @param string $Text Label text on the button
   * @param string $Url HTTP or tg:// url to be opened when the button is pressed. Links tg://user?id=<user_id> can be used to mention a user by their ID without using a username, if this is allowed by their privacy settings.
   * @link https://core.telegram.org/bots/api#inlinekeyboardmarkup
   */
  public function ButtonUrl(
    int $Line,
    int $Column,
    string $Text,
    string $Url
  ):void{
    $this->Pointer[$Line][$Column] = [
      'text' => $Text,
      'url' => $Url
    ];
  }

  /**
   * This object represents a parameter of the inline keyboard button used to automatically authorize a user. Serves as a great replacement for the Telegram Login Widget when the user is coming from Telegram. All the user needs to do is tap/click a button and confirm that they want to log in:
   * Telegram apps support these buttons as of version 5.7.
   * @param string $Text Label text on the button
   * @param string $Url An HTTP URL to be opened with user authorization data added to the query string when the button is pressed. If the user refuses to provide authorization data, the original URL without information about the user will be opened. The data added is the same as described in Receiving authorization data. NOTE: You must always check the hash of the received data to verify the authentication and the integrity of the data as described in Checking authorization.
   * @param bool $Write Pass True to request the permission for your bot to send messages to the user.
   * @param string $ForwardText New text of the button in forwarded messages.
   * @param string $BotName Username of a bot, which will be used for user authorization. See Setting up a bot for more details. If not specified, the current bot's username will be assumed. The url's domain must be the same as the domain linked with the bot. See Linking your domain to the bot for more details.
   * @link https://core.telegram.org/bots/api#loginurl
   */
  public function ButtonLogin(
    int $Line,
    int $Column,
    string $Text,
    string $Url,
    bool $Write = null,
    string $ForwardText = null,
    string $BotName = null
  ):void{
    $this->Pointer[$Line][$Column]['text'] = $Text;
    $this->Pointer[$Line][$Column]['login_url']['url'] = $Url;
    if($ForwardText !== null):
      $this->Pointer[$Line][$Column]['login_url']['forward_text'] = $ForwardText;
    endif;
    if($BotName !== null):
      $this->Pointer[$Line][$Column]['login_url']['bot_username'] = $BotName;
    endif;
    if($Write !== null):
      $this->Pointer[$Line][$Column]['login_url']['request_write_access'] = $Write;
    endif;
  }

  /**
   * @param string $Text Label text on the button
   * @param string $Data Data to be sent in a callback query to the bot when button is pressed, 1-64 bytes
   * @link https://core.telegram.org/bots/api#inlinekeyboardbutton
   */
  public function ButtonCallback(
    int $Line,
    int $Column,
    string $Text,
    string $Data
  ):bool{
    if(strlen($Data) > TgLimits::CallbackData):
      $this->Error = TblError::LimitCallbackData;
      return false;
    endif;
    $this->Pointer[$Line][$Column]['text'] = $Text;
    $this->Pointer[$Line][$Column]['callback_data'] = $Data;
    return true;
  }

  /**
   * @param string $Text Label text on the button
   * @param string $Query If set, pressing the button will prompt the user to select one of their chats, open that chat and insert the bot's username and the specified inline query in the input field. Can be empty, in which case just the bot's username will be inserted. Note: This offers an easy way for users to start using your bot in inline mode when they are currently in a private chat with it. Especially useful when combined with switch_pm… actions – in this case the user will be automatically returned to the chat they switched from, skipping the chat selection screen.
   * @param bool $OtherChat If set, pressing the button will insert the bot's username and the specified inline query in the current chat's input field. Can be empty, in which case only the bot's username will be inserted. This offers a quick way for the user to open your bot in inline mode in the same chat – good for selecting something from multiple options.
   */
  public function ButtonQuery(
    int $Line,
    int $Column,
    string $Text,
    string $Query = null,
    string $QueryOtherChat = null
  ):void{
    $this->Pointer[$Line][$Column]['text'] = $Text;
    if($Query !== null):
      $this->Pointer[$Line][$Column]['switch_inline_query_current_chat'] = $Query;
    endif;
    if($QueryOtherChat !== null):
      $this->Pointer[$Line][$Column]['switch_inline_query'] = $QueryOtherChat;
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

  /**
   * To send a Pay button. NOTE: This type of button must always be the first button in the first row and can only be used in invoice messages.
   * @return bool
   * @link https://core.telegram.org/bots/api#inlinekeyboardbutton
   */
  public function ButtonPay(
    int $Line,
    int $Column,
    string $Text
  ):bool{
    if($Line === 0 and $Column === 0):
      $this->Pointer[$Line][$Column]['text'] = $Text;
      $this->Pointer[$Line][$Column]['pay'] = true;
      return true;
    else:
      return false;
    endif;
  }
}

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

class TblMarkupRemove extends TblMarkup{
  /**
   * Upon receiving a message with this object, Telegram clients will remove the current custom keyboard and display the default letter-keyboard. By default, custom keyboards are displayed until a new keyboard is sent by a bot. An exception is made for one-time keyboards that are hidden immediately after the user presses a button (see ReplyKeyboardMarkup).
   * @param bool $Selective Optional. Use this parameter if you want to remove the keyboard for specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message. Example: A user votes in a poll, bot returns confirmation message in reply to the vote and removes the keyboard for that user, while still showing the keyboard with poll options to users who haven't voted yet.
   * @link https://core.telegram.org/bots/api#replykeyboardremove
   */
  public function __construct(bool $Selective = false){
    $this->Markup['remove_keyboard'] = 'true';
    $this->Markup['selective'] = $Selective;
  }
}

class TblMarkupForceReply extends TblMarkup{
  /**
   * Upon receiving a message with this object, Telegram clients will display a reply interface to the user (act as if the user has selected the bot's message and tapped 'Reply'). This can be extremely useful if you want to create user-friendly step-by-step interfaces without having to sacrifice privacy mode. Example: A poll bot for groups runs in privacy mode (only receives commands, replies to its messages and mentions). There could be two ways to create a new poll: Explain the user how to send a command with parameters (e.g. /newpoll question answer1 answer2). May be appealing for hardcore users but lacks modern day polish. Guide the user through a step-by-step process. 'Please send me your question', 'Cool, now let's add the first answer option', 'Great. Keep adding answer options, then send /done when you're ready'. The last option is definitely more attractive. And if you use ForceReply in your bot's questions, it will receive the user's answers even if it only receives replies, commands and mentions — without any extra work for the user.
   * @param string $Placeholder The placeholder to be shown in the input field when the reply is active; 1-64 characters
   * @param bool $Selective Use this parameter if you want to force reply from specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
   */
  public function __construct(
    string $Placeholder = null,
    bool $Selective = false
  ){
    $this->Markup['force_reply'] = true;
    if($Placeholder !== null):
      $this->Markup['input_field_placeholder'] = $Placeholder;
    endif;
    if($Selective):
      $this->Markup['selective'] = true;
    endif;
  }
}

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