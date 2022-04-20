<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.04.20.01

enum TgInvoiceCurrencies:string{
  case AED = 'AED';
  case AFN = 'AFN';
  case ALL = 'ALL';
  case AMD = 'AMD';
  case ARS = 'ARS';
  case AUD = 'AUD';
  case AZN = 'AZN';
  case BAM = 'BAM';
  case BDT = 'BDT';
  case BGN = 'BGN';
  case BND = 'BND';
  case BOB = 'BOB';
  case BRL = 'BRL';
  case CAD = 'CAD';
  case CHF = 'CHF';
  case CLP = 'CLP';
  case CNY = 'CNY';
  case COP = 'COP';
  case CRC = 'CRC';
  case CZK = 'CZK';
  case DKK = 'DKK';
  case DOP = 'DOP';
  case DZD = 'DZD';
  case EGP = 'EGP';
  case EUR = 'EUR';
  case GBP = 'GBP';
  case GEL = 'GEL';
  case GTQ = 'GTQ';
  case HKD = 'HKD';
  case HNL = 'HNL';
  case HRK = 'HRK';
  case HUF = 'HUF';
  case IDR = 'IDR';
  case ILS = 'ILS';
  case INR = 'INR';
  case ISK = 'ISK';
  case JMD = 'JMD';
  case JPY = 'JPY';
  case KES = 'KES';
  case KGS = 'KGS';
  case KRW = 'KRW';
  case KZT = 'KZT';
  case LBP = 'LBP';
  case LKR = 'LKR';
  case MAD = 'MAD';
  case MDL = 'MDL';
  case MNT = 'MNT';
  case MUR = 'MUR';
  case MVR = 'MVR';
  case MXN = 'MXN';
  case MYR = 'MYR';
  case MZN = 'MZN';
  case NGN = 'NGN';
  case NIO = 'NIO';
  case NOK = 'NOK';
  case NPR = 'NPR';
  case NZD = 'NZD';
  case PAB = 'PAB';
  case PEN = 'PEN';
  case PHP = 'PHP';
  case PKR = 'PKR';
  case PLN = 'PLN';
  case PYG = 'PYG';
  case QAR = 'QAR';
  case RON = 'RON';
  case RSD = 'RSD';
  case RUB = 'RUB';
  case SAR = 'SAR';
  case SEK = 'SEK';
  case SGD = 'SGD';
  case THB = 'THB';
  case TJS = 'TJS';
  case TRY = 'TRY';
  case TTD = 'TTD';
  case TWD = 'TWD';
  case TZS = 'TZS';
  case UAH = 'UAH';
  case UGX = 'UGX';
  case USD = 'USD';
  case UYU = 'UYU';
  case UZS = 'UZS';
  case VND = 'VND';
  case YER = 'YER';
  case ZAR = 'ZAR';
}

class TgInvoice extends TgMessage{
  public readonly TgInvoiceData $Data;

  public function __construct(array $Data){
    parent::__construct($Data);
    $this->Data = new TgInvoiceData($Data);
  }
}

class TgInvoiceData{
  public readonly string $Title;
  public readonly string $Description;
  public readonly string $StartParam;
  public readonly TgInvoiceCurrencies $Currency;
  public readonly Int $Amount;

  public function __construct(array $Data){
    $this->Title = $Data['title'];
    $this->Description = $Data['description'];
    $this->StartParam = $Data['start_parameter'];
    $this->Currency = TgInvoiceCurrencies::tryFrom($Data['currency']);
    $this->Amount = $Data['total_amount'];
  }
}

class TgInvoiceCheckout{
  public readonly string $Id;
  public readonly TgUser $User;
  public readonly TgInvoiceCurrencies $Currency;
  public readonly Int $Amount;
  public readonly string $Payload;

  public function __construct(array $Data){
    $this->Id = $Data['id'];
    $this->User = new TgUser($Data['from']);
    $this->Currency = TgInvoiceCurrencies::tryFrom($Data['currency']);
    $this->Amount = $Data['total_amount'];
    $this->Payload = $Data['invoice_payload'];
  }
}

/**
 * @link https://core.telegram.org/bots/api#successfulpayment
 */
class TgInvoiceDone extends TgMessage{
  public readonly TgInvoiceCurrencies $Currency;
  public readonly Int $Amount;
  public readonly string $Payload;
  public readonly TgInvoiceOrderInfo $OrderInfo;
  public readonly string $PayTelegramId;
  public readonly string $PayProviderId;

  /**
   * @link https://core.telegram.org/bots/api#successfulpayment
   */
  public function __construct(array $Data){
    parent::__construct($Data);
    $this->Currency = TgInvoiceCurrencies::tryFrom($Data['successful_payment']['currency']);
    $this->Amount = $Data['successful_payment']['total_amount'];
    $this->Payload = $Data['successful_payment']['invoice_payload'];
    $this->OrderInfo = new TgInvoiceOrderInfo($Data['successful_payment']['order_info']);
    $this->PayTelegramId = $Data['successful_payment']['telegram_payment_charge_id'];
    $this->PayProviderId = $Data['successful_payment']['provider_payment_charge_id'];
  }
}

/**
 * @link https://core.telegram.org/bots/api#orderinfo
 */
class TgInvoiceOrderInfo{
  public readonly string $Name;
  public readonly string $Phone;
  public readonly string $Email;
  public readonly TgInvoiceOrderAddress $Address;

  /**
   * @link https://core.telegram.org/bots/api#orderinfo
   */
  public function __construct(array $Data){
    $this->Name = $Data['name'];
    $this->Phone = $Data['phone_number'];
    $this->Email = $Data['email'];
    $this->Address = new TgInvoiceOrderAddress($Data['shipping_address']);
  }
}

/**
 * @link https://core.telegram.org/bots/api#shippingaddress
 */
class TgInvoiceOrderAddress{
  public readonly string $Country;
  public readonly string $State;
  public readonly string $City;
  public readonly string $Street1;
  public readonly string $Street2;
  public readonly string $ZipCode;
  
  /**
   * @link https://core.telegram.org/bots/api#shippingaddress
   */
  public function __construct(array $Data){
    $this->Country = $Data['country_code'];
    $this->State = $Data['state'];
    $this->City = $Data['city'];
    $this->Street1 = $Data['street_line1'];
    $this->Street2 = $Data['street_line2'];
    $this->ZipCode = $Data['post_code'];
  }
}