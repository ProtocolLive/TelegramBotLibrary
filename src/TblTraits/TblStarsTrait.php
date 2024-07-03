<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblTraits;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgMethods;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgStarTransaction;

/**
 * @version 2024.07.01.00
 */
trait TblStarsTrait{
  /**
   * Returns the bot's Telegram Star transactions in chronological order.
   * @return array On success, returns a StarTransactions object.
   * @link https://core.telegram.org/bots/api#getstartransactions
   */
  public function StarTransactionsGet(
    int $Offset = null,
    int $Limit = null
  ):array{
    if($Offset !== null):
      $param['offset'] = $Offset;
    endif;
    if($Limit !== null):
      $param['limit'] = $Limit;
    endif;
    $return = $this->ServerMethod(TgMethods::StarTransactionsGet, $param ?? null);
    $return = $return['transactions'];
    if($return === []):
      return [];
    endif;
    foreach($return as &$tx):
      $tx = new TgStarTransaction($tx);
    endforeach;
    return $return;
  }
}