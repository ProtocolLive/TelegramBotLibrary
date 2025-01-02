<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblTraits;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgMethods;

/**
 * @version 2025.01.02.00
 */
trait TblVerifyTrait{
  /**
   * Verifies a chat on behalf of the organization which is represented by the bot.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param string $Description Custom description for the verification; 0-70 characters. Must be empty if the organization isn't allowed to provide a custom verification description.
   * @return true Returns True on success.
   * @link https://core.telegram.org/bots/api#verifychat
   */
  public function VerifyChat(
    int|string $Chat,
    string|null $Description = null
  ):true{
    $param['chat_id'] = $Chat;
    if($Description !== null):
      $param['custom_description'] = $Description;
    endif;
    return self::ServerMethod(TgMethods::VerifyChat, $param);
  }

  /**
   * Removes verification from a chat that is currently verified on behalf of the organization represented by the bot.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @return true Returns True on success.
   * @link https://core.telegram.org/bots/api#removechatverification
   */
  public function VerifyChatDel(
    int|string $Chat
  ):true{
    $param['chat_id'] = $Chat;
    return self::ServerMethod(TgMethods::VerifyChatDel, $param);
  }

  /**
   * Verifies a user on behalf of the organization which is represented by the bot.
   * @param int $User Unique identifier of the target user
   * @param string $Description Custom description for the verification; 0-70 characters. Must be empty if the organization isn't allowed to provide a custom verification description.
   * @return true Returns True on success.
   * @link https://core.telegram.org/bots/api#verifyuser
   */
  public function VerifyUser(
    int $User,
    string|null $Description = null
  ):true{
    $param['user_id'] = $User;
    if($Description !== null):
      $param['custom_description'] = $Description;
    endif;
    return self::ServerMethod(TgMethods::VerifyUser, $param);
  }

  /**
   * Removes verification from a chat that is currently verified on behalf of the organization represented by the bot.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @return true Returns True on success.
   * @link https://core.telegram.org/bots/api#removeuserverification
   */
  public function VerifyUserDel(
    int|string $Chat
  ):true{
    $param['chat_id'] = $Chat;
    return self::ServerMethod(TgMethods::VerifyUserDel, $param);
  }
}