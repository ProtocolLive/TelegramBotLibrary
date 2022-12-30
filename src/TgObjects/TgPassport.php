<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.12.30.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#passportdata
 * @link https://core.telegram.org/bots/api#encryptedcredentials
 */
class TgPassport{
  public TgMessageData $Data;
  /**
   * Base64-encoded encrypted JSON-serialized data with unique user's payload, data hashes and secrets required for EncryptedPassportElement decryption and authentication
   * @link https://core.telegram.org/bots/api#encryptedcredentials
   */
  public string $Raw;
  /**
   * Base64-encoded data hash for data authentication
   * @link https://core.telegram.org/bots/api#encryptedcredentials
   */
  public string $Hash;
  /**
   * Base64-encoded secret, encrypted with the bot's public RSA key, required for data decryption
   * @link https://core.telegram.org/bots/api#encryptedcredentials
   */
  public string $Secret;

  public TgPassportDataPersonal $Personal;
  public TgPassportDataDriver $Driver;
  public TgPassportDataAddress $Address;
  public string $Phone;
  public string $Email;

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
        endif;
      endforeach;
    endif;
  }

  public function Decode(
    string $Privkey
  ):void{
    //Decode secret
    openssl_private_decrypt(
      $this->Secret,
      $temp,
      $Privkey,
      OPENSSL_PKCS1_OAEP_PADDING
    );
    $this->Secret = $temp;
    //Decode data
    $Data = self::DecodeData(
      $this->Raw,
      $this->Secret,
      $this->Hash
    );
    //Decode Address
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
    //Decode driver
    $temp = self::DecodeData(
      $this->Driver->Data,
      base64_decode($Data['secure_data']['driver_license']['data']['secret']),
      base64_decode($Data['secure_data']['driver_license']['data']['data_hash'])
    );
    $this->Driver->Number = $temp['document_no'];
    $this->Driver->Expiry = $temp['expiry_date'];
    //Decode personal
    $temp = self::DecodeData(
      $this->Personal->Data,
      base64_decode($Data['secure_data']['personal_details']['data']['secret']),
      base64_decode($Data['secure_data']['personal_details']['data']['data_hash'])
    );
    $this->Personal->Name = $temp['first_name'];
    $this->Personal->NameMiddle = $temp['middle_name'];
    $this->Personal->NameLast = $temp['last_name'];
    $this->Personal->Birthday = $temp['birth_date'];
    $this->Personal->Gender = $temp['gender'];
    $this->Personal->Country = $temp['country_code'];
    $this->Personal->CountryResidence = $temp['residence_country_code'];
  }

  public static function DecodeData(
    string $Data,
    string $Secret,
    string $Hash
  ){
    $Hash = hash('sha512', $Secret . $Hash, true);
    $key = substr($Hash, 0, 32);
    $iv = substr($Hash, 32, 16);
    $Data = openssl_decrypt(
      $Data,
      'aes-256-cbc',
      $key,
      OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING,
      $iv
    );
    $len = substr($Data, 0, 1);
    $len = bin2hex($len);
    $len = hexdec($len);
    $Data = substr($Data, $len);
    $Data = json_decode($Data, true);
    return $Data;
  }
}