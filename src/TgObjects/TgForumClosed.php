<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.12.08.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#forumtopicclosed
 */
final class TgForumClosed{
  public readonly TgMessage $Message;

  public function __construct(array $Data){
    $this->Message = new TgMessage($Data);
  }
}