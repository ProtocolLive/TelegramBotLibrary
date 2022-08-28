<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.19.00

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgLimits;

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
  ):TblError|null{
    if(substr($Url, 0, 5) !== 'https'):
      return TblError::InlineButtonLoginSsl;
    endif;
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
    return null;
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