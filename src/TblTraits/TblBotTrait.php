<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblTraits;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgMethods;

/**
 * @version 2026.04.08.00
 */
trait TblBotTrait{
  /**
   * Use this method to get the token of a managed bot
   * @param int $UserId User identifier of the managed bot whose token will be returned
   * @return string Returns the token as String on success.
   * @link https://core.telegram.org/bots/api#getmanagedbottoken
   */
  public function ManagedBotTokenGet(
    int $UserId
  ):string{
    $param['user_id'] = $UserId;
    return $this->ServerMethod(TgMethods::ManagedBotTokenGet, $param);
  }

  /**
   * Use this method to revoke the current token of a managed bot and generate a new one
   * @param int $UserId User identifier of the managed bot whose token will be replaced
   * @return string Returns the new token as String on success.
   * @link https://core.telegram.org/bots/api#replacemanagedbottoken
   */
  public function ManagedBotTokenReplace(
    int $UserId
  ):string{
    $param['user_id'] = $UserId;
    return $this->ServerMethod(TgMethods::ManagedBotTokenReplace, $param);
  }
}