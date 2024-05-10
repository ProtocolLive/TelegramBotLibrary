<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;

/**
 * The background is taken directly from a built-in chat theme.
 * @version 2024.05.07.00
 * @link https://core.telegram.org/bots/api#backgroundtypechattheme
 */
final readonly class TgBackgroundTypeChatTheme
extends TgBackgroundType{
  /**
   * Name of the chat theme, which is usually an emoji
   */
  public string $Theme;

  public function __construct(
    array $Data
  ){
    $this->Theme = $Data['theme_name'];
  }
}