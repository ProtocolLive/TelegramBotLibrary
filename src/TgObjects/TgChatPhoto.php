<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * This object represents a chat photo.
 * @link https://core.telegram.org/bots/api#chatphoto
 * @version 2024.01.04.00
 */
final readonly class TgChatPhoto{
  /**
   * File identifier of small (160x160) chat photo. This file_id can be used only for photo download and only for as long as the photo is not changed.
   */
  public string $SmallId;
  /**
   * Unique file identifier of small (160x160) chat photo, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
   */
  public string $SmallIdUnique;
  /**
   * File identifier of big (640x640) chat photo. This file_id can be used only for photo download and only for as long as the photo is not changed.
   */
  public string $BigId;
  /**
   * Unique file identifier of big (640x640) chat photo, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
   */
  public string $BigIdUnique;

  public function __construct(
    array $Data
  ){
    $this->SmallId = $Data['small_file_id'];
    $this->SmallIdUnique = $Data['small_file_unique_id'];
    $this->BigId = $Data['big_file_id'];
    $this->BigIdUnique = $Data['big_file_unique_id'];
  }
}