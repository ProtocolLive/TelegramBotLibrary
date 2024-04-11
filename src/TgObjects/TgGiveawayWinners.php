<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgForwadableInterface
};

/**
 * This object represents a message about the completion of a giveaway with public winners.
 * @link https://core.telegram.org/bots/api#giveawaywinners
 * @version 2024.04.11.00
 */
final readonly class TgGiveawayWinners
implements TgEventInterface, TgForwadableInterface{
  public TgMessageData $Data;
  /**
   * The chat that created the giveaway
   */
  public int $Chat;
  /**
   * Identifier of the messsage with the giveaway in the chat
   */
  public int $Message;
  /**
   * Point in time (Unix timestamp) when winners of the giveaway were selected
   */
  public int $Date;
  /**
   * Total number of winners in the giveaway
   */
  public int $Count;
  /**
   * List of up to 100 winners of the giveaway
   */
  public array $Winners;
  /**
   * The number of other chats the user had to join in order to be eligible for the giveaway
   */
  public int $AdditionalChatCount;
  /**
   * The number of months the Telegram Premium subscription won from the giveaway will be active for
   */
  public int|null $Months;
  /**
   * Number of undistributed prizes
   */
  public int $Unclaimed;
  /**
   * If only users who had joined the chats after the giveaway started were eligible to win
   */
  public bool $OnlyNew;
  /**
   * If the giveaway was canceled because the payment for it was refunded
   */
  public bool $Refunded;
  /**
   * Description of additional giveaway prize
   */
  public string $Additional;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Chat = $Data['chat'];
    $this->Message = $Data['giveaway_message_id'];
    $this->Date = $Data['winners_selection_date'];
    $this->Count = $Data['winner_count'];
    $temp = [];
    foreach($Data['winners'] as $winner):
      $temp[] = new TgUser($winner);
    endforeach;
    $this->Winners = $temp;
    $this->AdditionalChatCount = $Data['additional_chat_count'] ?? 0;
    $this->Months = $Data['premium_subscription_month_count'] ?? null;
    $this->Unclaimed = $Data['unclaimed_prize_count'] ?? 0;
    $this->OnlyNew = $Data['only_new_members'] ?? false;
    $this->Refunded = $Data['refunded'] ?? false;
    $this->Additional = $Data['prize_description'] ?? null;
  }
}