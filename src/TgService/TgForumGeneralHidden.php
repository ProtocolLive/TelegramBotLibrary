<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgService;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgServiceInterface
};

/**
 * @link https://core.telegram.org/bots/api#forumtopicedited
 * @version 2025.06.14.00
 */
final readonly class TgForumGeneralHidden
implements TgEventInterface,
TgServiceInterface{
  public TgMessageData $Data;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
  }
}