<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

use Exception;

/**
 * @link https://core.telegram.org/bots/api#passportdata
 * @link https://core.telegram.org/bots/api#encryptedcredentials
 * @link https://core.telegram.org/passport
 * @version 2023.06.20.00
 */
final class TgPassport
extends TgObject{
  public TgMessageData $Data;
  /**
   * Base64-encoded encrypted JSON-serialized data with unique user's payload, data hashes and secrets required for EncryptedPassportElement decryption and authentication
   */
  public string|null $Raw;
  /**
   * Base64-encoded data hash for data authentication
   */
  public string|null $Hash;
  /**
   * Base64-encoded secret, encrypted with the bot's public RSA key, required for data decryption
   */
  public string|null $Secret;
  /**
   * Credentials for encrypted personal details
   */
  public TgPassportDataPersonal $Personal;
  /**
   * Credentials for encrypted driver license
   */
  public TgPassportDataDriver|null $Driver = null;
  /**
   * Credentials for encrypted residential address
   */
  public TgPassportDataAddress|null $Address = null;
  /**
   * Credentials for encrypted utility bill
   */
  public array|null $UtilityBill = null;
  /**
   * User's verified phone number, available only for “phone_number” type
   */
  public string $Phone;
  /**
   * User's verified email address, available only for “email” type
   */
  public string $Email;
  /**
   * Bot-specified nonce
   */
  public string $Nonce;

  public function __construct(array $Data = null){
    if($Data !== null):
      $this->Data = new TgMessageData($Data);
      $this->Raw = base64_decode($Data['passport_data']['credentials']['data']);
      $this->Hash = base64_decode($Data['passport_data']['credentials']['hash']);
      $this->Secret = base64_decode($Data['passport_data']['credentials']['secret']);
      foreach($Data['passport_data']['data'] as $data):
        if($data['type'] === TgPassportDataType::PersonalDetail->value):
          $this->Personal = new TgPassportDataPersonal($data);
        elseif($data['type'] === TgPassportDataType::Driver->value):
          $this->Driver = new TgPassportDataDriver($data);
        elseif($data['type'] === TgPassportDataType::Address->value):
          $this->Address = new TgPassportDataAddress($data);
        elseif($data['type'] === TgPassportDataType::Email->value):
          $this->Email = $data['email'];
        elseif($data['type'] === TgPassportDataType::Phone->value):
          $this->Phone = $data['phone_number'];
        elseif($data['type'] === TgPassportDataType::DocUtility->value):
          foreach($data['files'] as $file):
            $this->UtilityBill[] = new TgPassportFile($file);
          endforeach;
        endif;
      endforeach;

    endif;
  }

  /**
   * @throws Exception
   */
  public function Decode(
    string $Privkey
  ):void{
    //1) Decrypt the credentials secret
    openssl_private_decrypt(
      $this->Secret,
      $this->Secret,
      $Privkey,
      OPENSSL_PKCS1_OAEP_PADDING
    );
    if($this->Secret === null):
      throw new Exception(openssl_error_string());
    endif;
    //2) Decode data
    $Data = self::DecodeData(
      $this->Raw,
      $this->Secret,
      $this->Hash
    );
    $this->Nonce = $Data['nonce'];
    //Decode Address
    if($this->Address !== null):
      $temp = self::DecodeData(
        $this->Address->Data,
        base64_decode($Data['secure_data']['address']['data']['secret']),
        base64_decode($Data['secure_data']['address']['data']['data_hash'])
      );
      $this->Address->City = $temp['city'];
      $this->Address->Country = $temp['country_code'];
      $this->Address->PostCode = $temp['post_code'];
      $this->Address->State = $temp['state'];
      $this->Address->Street1 = $temp['street_line1'];
      $this->Address->Street2 = $temp['street_line2'];
    endif;
    //Decode driver
    if($this->Driver !== null):
      $temp = self::DecodeData(
        $this->Driver->Data,
        base64_decode($Data['secure_data']['driver_license']['data']['secret']),
        base64_decode($Data['secure_data']['driver_license']['data']['data_hash'])
      );
      $this->Driver->Number = $temp['document_no'];
      $this->Driver->Expiry = $temp['expiry_date'];
    endif;
    //Decode personal
    $temp = self::DecodeData(
      $this->Personal->Data,
      base64_decode($Data['secure_data']['personal_details']['data']['secret']),
      base64_decode($Data['secure_data']['personal_details']['data']['data_hash'])
    );
    $this->Personal->Name = $temp['first_name'];
    $this->Personal->NameMiddle = $temp['middle_name'] === '' ? null : $temp['middle_name'];
    $this->Personal->NameLast = $temp['last_name'];
    $this->Personal->Birthday = $temp['birth_date'];
    $this->Personal->Sex = $temp['gender'];
    $this->Personal->Country = $temp['country_code'];
    $this->Personal->CountryResidence = $temp['residence_country_code'];
    //Cleanup
    $this->Raw = null;
    $this->Secret = null;
    $this->Hash = null;
    $this->Personal->Data = null;
    $this->Personal->Hash = null;
    if($this->Driver !== null):
      $this->Driver->Data = null;
      $this->Driver->Hash = null;
    endif;
    if($this->Address !== null):
      $this->Address->Data = null;
      $this->Address->Hash = null;
    endif;
  }


  public static function DecodeData(
    string $Data,
    string $Secret,
    string $Hash
  ):array{
    $keyiv = hash('sha512', $Secret . $Hash, true);
    $key = substr($keyiv, 0, 32);
    $iv = substr($keyiv, 32, 16);
    $Data = openssl_decrypt(
      $Data,
      'aes-256-cbc',
      $key,
      OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING,
      $iv
    );
    if($Hash !== hash('sha256', $Data, true)):
      throw new Exception('Invalid hash');
    endif;
    $len = ord($Data[0]);
    $Data = substr($Data, $len);
    $Data = json_decode($Data, true);
    return $Data;
  }
}