<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * This object represents personal details.
 * @link https://core.telegram.org/passport#personaldetails
 * @version 2024.01.04.01
 */
final class TgPassportDataPersonal{
  public string|null $Data;
  public string|null $Hash;
  /**
   * First Name
   */
  public string|null $Name = null;
  /**
   * Middle Name
   */
  public string|null $NameMiddle = null;
  /**
   * Last Name
   */
  public string|null $NameLast = null;
  /**
   * Date of birth in DD.MM.YYYY format
   */
  public string|null $Birthday = null;
  /**
   * Gender, male or female
   */
  public string|null $Sex = null;
  /**
   * Citizenship (ISO 3166-1 alpha-2 country code)
   */
  public string|null $Country = null;
  /**
   * Country of residence (ISO 3166-1 alpha-2 country code)
   */
  public string|null $CountryResidence = null;
  /**
   * First Name in the language of the user's country of residence
   */
  public string|null $NameNative = null;
  /**
   * Last Name in the language of the user's country of residence
   */
  public string|null $NameLastNative = null;
  /**
   * Middle Name in the language of the user's country of residence
   */
  public string|null $NameMiddleNative = null;

  public function __construct(
    array $Data
  ){
    $this->Data = base64_decode($Data['data']);
    $this->Hash = base64_decode($Data['hash']);
  }
}