<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.09.17.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#passportdata
 * @link https://core.telegram.org/bots/api#encryptedcredentials
 */
class TgPassport{
  public readonly TgMessage $Message;
  /**
   * Base64-encoded encrypted JSON-serialized data with unique user's payload, data hashes and secrets required for EncryptedPassportElement decryption and authentication
   * @link https://core.telegram.org/bots/api#encryptedcredentials
   */
  public readonly string $Raw;
  /**
   * Base64-encoded data hash for data authentication
   * @link https://core.telegram.org/bots/api#encryptedcredentials
   */
  public readonly string $Hash;
  /**
   * Base64-encoded secret, encrypted with the bot's public RSA key, required for data decryption
   * @link https://core.telegram.org/bots/api#encryptedcredentials
   */
  public readonly string $Secret;
  /**
   * Array with information about documents and other Telegram Passport elements that was shared with the bot
   * @link https://core.telegram.org/bots/api#encryptedpassportelement
   */
  public array $Data;

  public function __construct(array $Data){
    $this->Message = new TgMessage($Data);
    $this->Raw = $Data['passport_data']['credentials']['data'];
    $this->Hash = $Data['passport_data']['credentials']['hash'];
    $this->Secret = $Data['passport_data']['credentials']['secret'];
    foreach($Data['passport_data']['data'] as $data):
      $this->Data[] = new TgPassportData($data);
    endforeach;
  }
}