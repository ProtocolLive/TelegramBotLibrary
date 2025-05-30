<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblTraits;
use ProtocolLive\TelegramBotLibrary\TblObjects\{
  TblCommands,
  TblCurlResponse,
  TblDefaultPerms,
  TblException
};
use ProtocolLive\TelegramBotLibrary\TgEnums\{
  TgCmdScope,
  TgError,
  TgLanguages,
  TgMenuButton,
  TgMethods
};
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgBot,
  TgLimits,
  TgPermAdmin
};

/**
 * @version 2025.05.29.00
 */
trait TblMyTrait{
  /**
   * Use this method to delete the list of the bot's commands for the given scope and user language. After deletion, higher level commands will be shown to affected users.
   * @param TgCmdScope $Scope A JSON-serialized object, describing scope of users for which the commands are relevant. Defaults to BotCommandScopeDefault.
   * @param TgLanguages $Language A two-letter ISO 639-1 language code. If empty, commands will be applied to all users from the given scope, for whose language there are no dedicated commands
   * @return TblCurlResponse Returns True on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#deletemycommands
   */
  public function MyCmdClear(
    TgCmdScope|null $Scope = null,
    TgLanguages|null $Language = null,
    int|null $Chat = null,
    int|null $User = null
  ):TblCurlResponse{
    $param = [];
    if($Scope !== null):
      $param['scope']['type'] = $Scope->value;
      if($Scope === TgCmdScope::Chat
      or $Scope === TgCmdScope::GroupAdmins
      or $Scope === TgCmdScope::Member):
        $param['scope']['chat_id'] = $Chat;
      endif;
      if($Scope === TgCmdScope::Member):
        $param['scope']['user_id'] = $User;
      endif;
    endif;
    if($Language !== null):
      $param['language_code'] = $Language->value;
    endif;
    return $this->ServerMethod(TgMethods::CommandsDel, $param);
  }

  /**
   * Use this method to get the current list of the bot's commands for the given scope and user language.
   * @param TgCmdScope $Scope A JSON-serialized object, describing scope of users. Defaults to TgCmdScope::Default.
   * @param TgLanguages $Language A two-letter ISO 639-1 language code or an empty string
   * @param int $Chat Unique identifier for the target chat. Only for TgCmdScope::Chat, TgCmdScope::GroupsAdmins or TgCmdScope::Member
   * @param int $User Unique identifier of the target user. Only for TgCmdScope::Member
   * @throws TblException
   * @link https://core.telegram.org/bots/api#getmycommands
   */
  public function MyCmdGet(
    TgCmdScope|null $Scope = null,
    TgLanguages|null $Language = null,
    int|null $Chat = null,
    int|null $User = null
  ):TblCommands{
    $param = [];
    if($Scope !== null):
      $param['scope']['type'] = $Scope->value;
      if($Scope === TgCmdScope::Chat
      or $Scope === TgCmdScope::GroupAdmins
      or $Scope === TgCmdScope::Member):
        $param['scope']['chat_id'] = $Chat;
      endif;
      if($Scope === TgCmdScope::Member):
        $param['scope']['user_id'] = $User;
      endif;
    endif;
    if($Language !== null):
      $param['language_code'] = $Language->value;
    endif;
    $return = $this->ServerMethod(TgMethods::CommandsGet, $param)->Response;
    if($return === []):
      return new TblCommands;
    else:
      return new TblCommands($return);
    endif;
  }

  /**
   * Use this method to change the list of the bot's commands.
   * @param TblCommands $Commands A JSON-serialized list of bot commands to be set as the list of the bot's commands. At most 100 commands can be specified.
   * @param TgCmdScope $Scope A JSON-serialized object, describing scope of users for which the commands are relevant. Defaults to TgCmdScope::Default
   * @param TgLanguages $Language A two-letter ISO 639-1 language code. If empty, commands will be applied to all users from the given scope, for whose language there are no dedicated commands
   * @return TblCurlResponse Returns True on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#setmycommands
   */
  public function MyCmdSet(
    TblCommands $Commands,
    TgCmdScope|null $Scope = null,
    TgLanguages|null $Language = null,
    int|null $Chat = null,
    int|null $User = null
  ):TblCurlResponse{
    $param['commands'] = $Commands->ToArray();
    if($Scope !== null):
      $param['scope']['type'] = $Scope->value;
      if($Scope === TgCmdScope::Chat
      or $Scope === TgCmdScope::GroupAdmins
      or $Scope === TgCmdScope::Member):
        $param['scope']['chat_id'] = $Chat;
      endif;
      if($Scope === TgCmdScope::Member):
        $param['scope']['user_id'] = $User;
      endif;
    endif;
    if($Language !== null):
      $param['language_code'] = $Language->value;
    endif;
    return $this->ServerMethod(TgMethods::CommandsSet, $param);
  }

  /**
   * Use this method to get the current bot description for the given user language.
   * @param TgLanguages $Language A two-letter ISO 639-1 language code or an empty string
   * @return string Returns BotDescription on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#getmydescription
   */
  public function MyDescriptionGet(
    TgLanguages|null $Language = null
  ):string{
    $params = [];
    if($Language !== null):
      $params['language_code'] = $Language->value;
    endif;
    $return = $this->ServerMethod(TgMethods::DescriptionGet, $params)->Response;
    return $return['description'];
  }

  /**
   * Use this method to change the bot's description, which is shown in the chat with the bot if the chat is empty.
   * @param string $Description New bot description; 0-512 characters. Pass an empty string to remove the dedicated description for the given language.
   * @param TgLanguages $Language A two-letter ISO 639-1 language code. If empty, the description will be applied to all users for whose language there is no dedicated description.
   * @return TblCurlResponse Returns True on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#setmydescription
   */
  public function MyDescriptionSet(
    string|null $Description = null,
    TgLanguages|null $Language = null
  ):TblCurlResponse{
    $params = [];
    if($Description !== null):
      if(mb_strlen($Description) > TgLimits::Description):
        throw new TblException(
          TgError::LimitDescription,
          'Bot description exceeds ' . TgLimits::Description . ' characters'
        );
      endif;
      $params['description'] = $Description;
    endif;
    if($Language !== null):
      $params['language_code'] = $Language->value;
    endif;
    return $this->ServerMethod(TgMethods::DescriptionSet, $params);
  }

  /**
   * Use this method to get the current bot short description for the given user language.
   * @param TgLanguages $Language A two-letter ISO 639-1 language code or an empty string
   * @return string Returns BotShortDescription on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#getmyshortdescription
   */
  public function MyDescriptionShortGet(
    TgLanguages|null $Language = null
  ):string{
    $params = [];
    if($Language !== null):
      $params['language_code'] = $Language->value;
    endif;
    $return = $this->ServerMethod(TgMethods::DescriptionShortGet, $params)->Response;
    return $return['short_description'];
  }

  /**
   * Use this method to change the bot's short description, which is shown on the bot's profile page and is sent together with the link when users share the bot.
   * @param string $Description New short description for the bot; 0-120 characters. Pass an empty string to remove the dedicated short description for the given language.
   * @param TgLanguages $Language A two-letter ISO 639-1 language code. If empty, the short description will be applied to all users for whose language there is no dedicated short description.
   * @return TblCurlResponse Returns True on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#setmyshortdescription
   */
  public function MyDescriptionShortSet(
    string|null $Description = null,
    TgLanguages|null $Language = null
  ):TblCurlResponse{
    $params = [];
    if($Description !== null):
      if(mb_strlen($Description) > TgLimits::DescriptionShort):
        throw new TblException(
          TgError::LimitDescriptionShort,
          'Bot short description exceeds ' . TgLimits::DescriptionShort . ' characters'
        );
      endif;
      $params['short_description'] = $Description;
    endif;
    if($Language !== null):
      $params['language_code'] = $Language->value;
    endif;
    return $this->ServerMethod(TgMethods::DescriptionShortSet, $params);
  }

  /**
   * A simple method for testing your bot's authentication token. Requires no parameters.
   * @return TgBot Returns basic information about the bot in form of a User object.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#getme
   */
  public function MyGet():TgBot{
    return new TgBot($this->ServerMethod(TgMethods::MyGet)->Response);
  }

  /**
   * Use this method to get the current value of the bot's menu button in a private chat, or the default menu button.
   * @param int $User Unique identifier for the target private chat. If not specified, default bot's menu button will be returned
   * @return TgMenuButton Returns TgMenuButton on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#getchatmenubutton
   */
  public function MyMenuButtonGet(
    int|null $User = null
  ):TgMenuButton{
    $param = [];
    if($User !== null):
      $param['chat_id='] = $User;
    endif;
    $return = $this->ServerMethod(TgMethods::ChatMenuButtonGet, $param)->Response;
    return TgMenuButton::from($return['type']);
  }

  /**
   * Use this method to change the bot's menu button in a private chat, or the default menu button.
   * @param TgMenuButton $Type A type for the new bot's menu button. Defaults to TgMenuButton::Default
   * @param int $User Unique identifier for the target private chat. If not specified, default bot's menu button will be changed
   * @param string $Text Text on the button
   * @param string $Url URL of the Web App that will be launched when the user presses the button. The Web App will be able to send an arbitrary message on behalf of the user using the method answerWebAppQuery. An HTTPS URL of a Web App to be opened with additional data as specified in Initializing Web Apps
   * @return TblCurlResponse Returns True on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#setchatmenubutton
   */
  public function MyMenuButtonSet(
    TgMenuButton|null $Type = null,
    int|null $User = null,
    string|null $Text = null,
    string|null $Url = null
  ):TblCurlResponse{
    $param = [];
    if($User !== null):
      $param['chat_id'] = $User;
    endif;
    if($Type === TgMenuButton::WebApp):
      $param['menu_button']['text'] = $Text;
      $param['menu_button']['web_app'] = ['url' => $Url];
    endif;
    if($Type !== null):
      $param['menu_button']['type'] = $Type->value;
    endif;
    return $this->ServerMethod(TgMethods::ChatMenuButtonSet, $param);
  }

  /**
   * Use this method to get the current bot name for the given user language.
   * @param TgLanguages $Language A two-letter ISO 639-1 language code or an empty string
   * @return string BotName on success.
   * @link https://core.telegram.org/bots/api#getmyname
   */
  public function MyNameGet(
    TgLanguages|null $Language = null
  ):string{
    $params = [];
    if($Language !== null):
      $params['language_code'] = $Language->value;
    endif;
    $return = $this->ServerMethod(TgMethods::NameGet, $params)->Response;
    return $return['name'];
  }

  /**
   * Use this method to get the current bot name for the given user language.
   * @param string $Name New bot name; 0-64 characters. Pass an empty string to remove the dedicated name for the given language.
   * @param TgLanguages $Language A two-letter ISO 639-1 language code. If empty, the name will be shown to all users for whose language there is no dedicated name.
   * @return TblCurlResponse BotName on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#getmyname
   */
  public function MyNameSet(
    string|null $Name = null,
    TgLanguages|null $Language = null
  ):TblCurlResponse{
    $params = [];
    if(strlen($Name) > TgLimits::Name):
      throw new TblException(TgError::LimitName, 'Bot name exceeds ' . TgLimits::Name . ' characters');
    endif;
    if($Language !== null):
      $params['language_code'] = $Language->value;
    endif;
    return $this->ServerMethod(TgMethods::NameSet, $params);
  }

  /**
   * Use this method to get the current default administrator rights of the bot.
   * @param TblDefaultPerms $Type Pass Channels to get default administrator rights of the bot in channels. Otherwise, default administrator rights of the bot for groups and supergroups will be returned.
   * @return mixed Returns TgPermAdmin on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#getmydefaultadministratorrights
   */
  public function MyPermDefaultGet(
    TblDefaultPerms $Type = TblDefaultPerms::Groups
  ):TgPermAdmin{
    $param = [];
    if($Type === TblDefaultPerms::Channels):
      $param['for_channels'] = true;
    endif;
    $return = $this->ServerMethod(TgMethods::MyDefaultPermAdmGet, $param)->Response;
    return new TgPermAdmin($return);
  }

  /**
   * Use this method to change the default administrator rights requested by the bot when it's added as an administrator to groups or channels. These rights will be suggested to users, but they are are free to modify the list before adding the bot.
   * @param TgPermAdmin $Perms An object describing new default administrator rights. If not specified, the default administrator rights will be cleared.
   * @param TblDefaultPerms $Type Pass Channels to change the default administrator rights of the bot in channels. Otherwise, the default administrator rights of the bot for groups and supergroups will be changed.
   * @return TblCurlResponse Returns True on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#setmydefaultadministratorrights
   */
  public function MyPermDefaultSet(
    TgPermAdmin $Perms,
    TblDefaultPerms $Type = TblDefaultPerms::Groups
  ):TblCurlResponse{
    foreach(TgPermAdmin::Array as $class => $json):
      $param['rights'][$json] = $Perms->$class;
    endforeach;
    if($Type === TblDefaultPerms::Channels):
      $param['for_channels'] = true;
    endif;
    return $this->ServerMethod(TgMethods::MyDefaultPermAdmSet, $param);
  }
}