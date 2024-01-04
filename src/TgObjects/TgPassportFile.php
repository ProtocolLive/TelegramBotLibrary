<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#passportfile
 * @version 2024.01.04.00
 */
final readonly class TgPassportFile{
  /**
   * Identifier for this file, which can be used to download or reuse the file
   */
  public string $Id;
  /**
   * Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
   */
  public string $IdUnique;
  /**
   * File size in bytes
   */
  public int $Size;
  /**
   * Unix time when the file was uploaded
   */
  public int $Date;

  public function __construct(
    array $Data
  ){
    $this->Id = $Data['file_id'];
    $this->IdUnique = $Data['file_unique_id'];
    $this->Size = $Data['file_size'];
    $this->Date = $Data['file_date'];
  }
}