<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#gamehighscore
 * @version 2024.01.03.00
 */
final readonly class TgGameScore{
  /**
   * Position in high score table for the game
   */
  public int $Position;
  /**
   * User
   */
  public TgUser $User;
  /**
   * Score
   */
  public int $Score;

  public function __construct(
    array $Data
  ){
    $this->Position = $Data['position'];
    $this->User = new TgUser($Data['user']);
    $this->Score = $Data['score'];
  }
}