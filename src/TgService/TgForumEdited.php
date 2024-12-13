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
 * @version 2024.12.13.00
 */
final readonly class TgForumEdited
implements TgEventInterface,
TgServiceInterface{
  public TgMessageData $Data;
  /**
   * New name of the topic, if it was edited
   */
  public string|null $Name;
  /**
   * New identifier of the custom emoji shown as the topic icon, if it was edited; an empty string if the icon was removed
   */
  public string|null $Emoji;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Name = $Data['forum_topic_edited']['name'] ?? null;
    $this->Emoji = $Data['forum_topic_edited']['icon_custom_emoji_id'] ?? null;
  }
}