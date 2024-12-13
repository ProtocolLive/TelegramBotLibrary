<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgService;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\{
  TgBackgroundType,
  TgBackgroundTypeChatTheme,
  TgBackgroundTypeWallpaper,
  TgMessageData
};
use ProtocolLive\TelegramBotLibrary\TgEnums\TgBackgroundType as TgBackgroundTypeEnum;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgServiceInterface
};

/**
 * @link https://core.telegram.org/bots/api#chatbackground
 * 
 * @version 2024.12.13.00
 */
final readonly class TgBackground
implements TgEventInterface,
TgServiceInterface{
  public TgMessageData $Data;
  public TgBackgroundType $Type;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    if($Data['chat_background_set']['type']['type'] === TgBackgroundTypeEnum::Wallpaper->value):
      $this->Type = new TgBackgroundTypeWallpaper($Data['chat_background_set']['type']);
    elseif($Data['chat_background_set']['type']['type'] === TgBackgroundTypeEnum::Theme->value):
      $this->Type = new TgBackgroundTypeChatTheme($Data['chat_background_set']['type']);
    endif;
  }
}