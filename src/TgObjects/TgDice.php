<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgForwadableInterface,
  TgMessageInterface
};

/**
 * @link https://core.telegram.org/bots/api#dice
 * @version 2024.07.05.00
 */
final readonly class TgDice
implements TgEventInterface,
TgForwadableInterface,
TgMessageInterface{
  public TgMessageData $Data;
  /**
   * Emoji on which the dice throw animation is based
   */
  public string $Emoji;
  /**
   * Value of the dice, 1-6 for “🎲”, “🎯” and “🎳” base emoji, 1-5 for “🏀” and “⚽” base emoji, 1-64 for “🎰” base emoji
   */
  public int $Value;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Emoji = $Data['dice']['emoji'];
    $this->Value = $Data['dice']['value'];
  }
}