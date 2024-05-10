<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;

/**
 * @version 2024.05.07.00
 * @link https://core.telegram.org/bots/api#backgroundfillsolid
 */
abstract readonly class TgBackgroundFillSolid
extends TgBackgroundFill{
  public int $Color;
}