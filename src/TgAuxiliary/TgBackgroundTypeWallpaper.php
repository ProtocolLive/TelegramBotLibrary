<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgDocument;

/**
 * The background is a wallpaper in the JPEG format.
 * @version 2024.05.07.00
 * @link https://core.telegram.org/bots/api#backgroundtypewallpaper
 */
final readonly class TgBackgroundTypeWallpaper
extends TgBackgroundType{
  /**
   * Document with the wallpaper
   */
  public TgDocument $Document;
  /**
   * Dimming of the background in dark themes, as a percentage; 0-100
   */
  public int $DarkThemeDimming;
  /**
   * If the wallpaper is downscaled to fit in a 450x450 square and then box-blurred with radius 12
   */
  public bool $Blurred;
  /**
   * If the background moves slightly when the device is tilted
   */
  public bool $Moving;

  public function __construct(
    array $Data
  ){
    $this->Document = new TgDocument($Data['document']);
    $this->DarkThemeDimming = $Data['dark_theme_dimming'];
    $this->Blurred = $Data['is_blurred'] ?? false;
    $this->Moving = $Data['is_moving'] ?? false;
  }
}