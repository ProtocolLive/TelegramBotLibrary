<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgForwadableInterface,
  TgServiceInterface
};

/**
 * Message is a game, information about the game.
 * @link https://core.telegram.org/bots/api#game
 * @version 2024.01.03.00
 */
final readonly class TgGameEdited
extends TgGame
implements TgEventInterface, TgForwadableInterface, TgServiceInterface{
  public function __construct(
    array $Data
  ){
    parent::__construct($Data);
  }
}