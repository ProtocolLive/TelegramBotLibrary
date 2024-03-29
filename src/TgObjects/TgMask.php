<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * This object describes the position on faces where a mask should be placed by default.
 * @link https://core.telegram.org/bots/api#maskposition
 * @version 2024.01.04.01
 */
final readonly class TgMask{
  /**
   * The part of the face relative to which the mask should be placed. One of “forehead”, “eyes”, “mouth”, or “chin”.
   */
  public int $Point;
  /**
   * Shift by X-axis measured in widths of the mask scaled to the face size, from left to right. For example, choosing -1.0 will place mask just to the left of the default mask position.
   */
  public float $XShift;
  /**
   * Shift by Y-axis measured in heights of the mask scaled to the face size, from top to bottom. For example, 1.0 will place the mask just below the default mask position.
   */
  public float $YShift;
  /**
   * Mask scaling coefficient. For example, 2.0 means double size.
   */
  public float $Scale;

  public function __construct(
    array $Data
  ){
    $this->Point = $Data['point'];
    $this->XShift = $Data['x_shift'];
    $this->YShift = $Data['y_shift'];
    $this->Scale = $Data['scale'];
  }
}