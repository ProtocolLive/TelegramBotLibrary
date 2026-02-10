<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgSticker;

/**
 * This object contains information about the color scheme for a user's name, message replies and link previews based on a unique gift.
 * @link https://core.telegram.org/bots/api#uniquegiftcolors
 * @version 2026.02.09.00
 */
final readonly class TgGiftUniqueColors{
  /**
   * Custom emoji identifier of the unique gift's model
   */
  public string $ModelEmoji;
  /**
   * Custom emoji identifier of the unique gift's symbol
   */
  public string $SymbolEmoji;
  /**
   * Main color used in light themes; RGB format
   */
  public int $MainColor;
  /**
   * List of 1-3 additional colors used in light themes; RGB format
   */
  public array $OtherColor;
  /**
   * Main color used in dark themes; RGB format
   */
  public int $DarkModeColor;
  /**
   * List of 1-3 additional colors used in dark themes; RGB format
   */
  public array $DarkModeOtherColor;

  public function __construct(
    array $Data
  ){
    $this->ModelEmoji = $Data['model_custom_emoji_id'];
    $this->SymbolEmoji = $Data['symbol_custom_emoji_id'];
    $this->MainColor = $Data['light_theme_main_color'];
    $this->OtherColor = $Data['light_theme_other_colors'];
    $this->DarkModeColor = $Data['dark_theme_main_color'];
    $this->DarkModeOtherColor = $Data['dark_theme_other_colors'];
  }
}