<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgEnums;

/**
 * @version 2024.01.01.00
 */
enum TgPassportDataType:string{
  case Address = 'address';
  case DocBank = 'bank_statement';
  case DocRental = 'rental_agreement';
  case DocUtility = 'utility_bill';
  case Driver = 'driver_license';
  case Email = 'email';
  case Identity = 'identity_card';
  case Passport = 'passport';
  case PassportInternal = 'internal_passport';
  case PersonalDetail = 'personal_details';
  case Phone = 'phone_number';
  case RegPassport = 'passport_registration';
  case RegTemp = 'temporary_registration';
}