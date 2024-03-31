<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @version 2024.03.31.00
 * @link https://core.telegram.org/bots/api#businessintro
 */
final readonly class TgBusinessIntro{
  /**
   * Title text of the business intro
   */
  public string $Title;
  /**
   * Message text of the business intro
   */
  public string $Message;
  /**
   * Sticker of the business intro
   */
  public TgSticker $Sticker;

  public function __construct(
    array $Data
  ){
    $this->Title = $Data['title'];
    $this->Message = $Data['message'];
    $this->Sticker = new TgSticker($Data['sticker']);
  }
}