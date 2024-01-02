<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#file
 * @version 2024.01.02.00
 */
final readonly class TgFile{
  /**
   * Identifier for this file, which can be used to download or reuse the file
   */
  public string $Id;
  /**
   * Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
   */
  public string $IdUnique;
  /**
   * File size in bytes. It can be bigger than 2^31 and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this value.
   */
  public int $Size;
  /**
   * File path. Use https://api.telegram.org/file/bot<token>/<file_path> to get the file.
   */
  public string|null $Path;

  public function __construct(
    array $Data
  ){
    $this->Id = $Data['file_id'];
    $this->IdUnique = $Data['file_unique_id'];
    $this->Size = $Data['file_size'];
    $this->Path = $Data['file_path'] ?? null;
  }
}