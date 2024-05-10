<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgDocument;

/**
 * The background is a PNG or TGV (gzipped subset of SVG with MIME type “application/x-tgwallpattern”) pattern to be combined with the background fill chosen by the user.
 * @version 2024.05.07.00
 * @link https://core.telegram.org/bots/api#backgroundtypepattern
 */
final readonly class TgBackgroundTypePattern
extends TgBackgroundType{
  /**
   * Document with the pattern
   */
  public TgDocument $Image;
  /**
   * The background fill that is combined with the pattern
   */
  public TgBackgroundFill $Fill;
  /**
   * Intensity of the pattern when it is shown above the filled background; 0-100
   */
  public int $Intensity;
  /**
   * if the background fill must be applied only to the pattern itself. All other pixels are black in this case. For dark themes only
   */
  public bool $Inverted;
  /**
   * If the background moves slightly when the device is tilted
   */
  public bool $Moving;
}