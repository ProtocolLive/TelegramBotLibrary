<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;

/**
 * The background is automatically filled based on the selected colors.
 * @version 2024.05.07.00
 * @link https://core.telegram.org/bots/api#backgroundtypefill
 */
final readonly class TgBackgroundTypeFill
extends TgBackgroundType{
  /**
   * The background fill
   */
  public TgBackgroundFill $Fill;
  /**
   * Dimming of the background in dark themes, as a percentage; 0-100
   */
  public int $DarkThemeDimming;
}