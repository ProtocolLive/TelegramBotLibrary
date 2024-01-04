<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * This object represents the data of an identity document.
 * @version 2024.01.04.01
 */
final class TgPassportDataDriver{
  public string|null $Data;
  public string|null $Hash;
  /**
   * Document number
   */
  public string|null $Number = null;
  /**
   * Date of expiry, in DD.MM.YYYY format
   */
  public string|null $Expiry = null;
  public TgPassportFile|null $Front = null;
  public TgPassportFile|null $Back = null;

  public function __construct(
    array $Data
  ){
    $this->Data = base64_decode($Data['data']);
    $this->Hash = base64_decode($Data['hash']);
    $this->Front = new TgPassportFile($Data['front_side']);
    $this->Back = new TgPassportFile($Data['reverse_side']);
  }
}