<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgForwadableInterface;

/**
 * @link 
 * @version 2023.12.31.00
 */
final class TgGiveaway
extends TgObject
implements TgForwadableInterface{
  public readonly TgMessageData $Data;
  /**
   * The list of chats which the user must join to participate in the giveaway
   */
  public array $Chats = [];
  /**
   * Point in time (Unix timestamp) when winners of the giveaway will be selected
   */
  public readonly int $Date;
  /**
   * The number of users which are supposed to be selected as winners of the giveaway
   */
  public readonly int $Winners;
  /**
   * True, if the list of giveaway winners will be visible to everyone
   */
  public readonly bool $Public;
  /**
   * The number of months the Telegram Premium subscription won from the giveaway will be active for
   */
  public readonly int|null $Months;
  /**
   * True, if only users who join the chats after the giveaway started should be eligible to win
   */
  public readonly bool $OnlyNew;
  /**
   * A list of two-letter ISO 3166-1 alpha-2 country codes indicating the countries from which eligible users for the giveaway must come. If empty, then all users can participate in the giveaway. Users with a phone number that was bought on Fragment can always participate in giveaways.
   */
  public array $Countries = [];
  /**
   * Description of additional giveaway prize
   */
  public readonly string|null $Additional;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    foreach($Data['giveaway']['chats'] as $chat):
      $this->Chats[] = new TgChat($chat);
    endforeach;
    $this->Date = $Data['giveaway']['winners_selection_date'];
    $this->Winners = $Data['giveaway']['winner_count'];
    $this->OnlyNew = $Data['giveaway']['only_new_members'] ?? false;
    $this->Public = $Data['giveaway']['has_public_winners'] ?? false;
    $this->Additional = $Data['giveaway']['prize_description'] ?? null;
    $this->Countries = $Data['giveaway']['country_codes'] ?? [];
    $this->Months = $Data['giveaway']['premium_subscription_month_count'] ?? null;
  }
}