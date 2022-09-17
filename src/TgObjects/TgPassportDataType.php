<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.09.17.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

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