<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;

/**
 * @version 2024.05.07.00
 * @link https://core.telegram.org/bots/api#backgroundfillgradient
 */
abstract readonly class TgBackgroundFillGradient
extends TgBackgroundFill{
  /**
   * Top color of the gradient in the RGB24 format
   */
  public int $ColorTop;
  /**
   * Bottom color of the gradient in the RGB24 format
   */
  public int $ColorBottom;
  /**
   * Clockwise rotation angle of the background fill in degrees; 0-359
   */
  public int $Angle;
}