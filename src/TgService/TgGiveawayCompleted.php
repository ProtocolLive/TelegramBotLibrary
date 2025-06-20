<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgService;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgServiceInterface
};
use ProtocolLive\TelegramBotLibrary\TgObjects\TgGiveaway;

/**
 * This object represents a service message about the completion of a giveaway without public winners.
 * @link https://core.telegram.org/bots/api#giveawaycompleted
 * @version 2025.06.17.00
 */
final readonly class TgGiveawayCompleted
implements TgEventInterface,
TgServiceInterface{
  public TgMessageData $Data;
  /**
   * Number of winners in the giveaway
   */
  public int $Winners;
  /**
   * Number of undistributed prizes
   */
  public int $Unclaimed;
  /**
   * Message with the giveaway that was completed, if it wasn't deleted
   */
  public TgGiveaway|null $Message;
  /**
   * If the giveaway is a Telegram Star giveaway. Otherwise, currently, the giveaway is a Telegram Premium giveaway.
   */
  public bool $Star;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Winners = $Data['giveaway_completed']['winner_count'];
    $this->Unclaimed = $Data['giveaway_completed']['unclaimed_prize_count'] ?? 0;
    $this->Star = $Data['giveaway_completed']['is_star_giveaway'] ?? false;
    if(isset($Data['giveaway_completed']['giveaway_message'])):
      $this->Message = new TgGiveaway($Data['giveaway_completed']['unclaimed_prize_count']);
    else:
      $this->Message = null;
    endif;
  }
}