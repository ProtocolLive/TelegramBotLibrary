<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;

/**
 * This object describes the rating of a user based on their Telegram Star spendings.
 * @link https://core.telegram.org/bots/api#userrating
 * @version 2026.02.09.00
 */
final readonly class TgUserRating{
  /**
   * Current level of the user, indicating their reliability when purchasing digital goods and services. A higher level suggests a more trustworthy customer; a negative level is likely reason for concern.
   */
  public int $Level;
  /**
   * Numerical value of the user's rating; the higher the rating, the better
   */
  public float $Rating;
  /**
   * The rating value required to get the current level
   */
  public int $LevelRating;
  /**
   * The rating value required to get to the next level; omitted if the maximum level was reached
   */
  public int|null $NextLevelRating;

  public function __construct(
    array $Data
  ){
    $this->Level = $Data['level'];
    $this->Rating = $Data['rating'];
    $this->LevelRating = $Data['current_level_rating'];
    $this->NextLevelRating = $Data['next_level_rating'] ?? null;
  }
}