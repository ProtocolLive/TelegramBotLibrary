<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgForwadableInterface
};

/**
 * @link https://core.telegram.org/bots/api#contact
 * @version 2024.04.11.01
 */
final readonly class TgContact
implements TgEventInterface, TgForwadableInterface{
  public TgMessageData $Data;
  /**
   * Contact's phone number
   */
  public string $Number;
  /**
   * Contact's first name
   */
  public string $Name;
  /**
   * Contact's first name
   */
  public string|null $NameLast;
  /**
   * Contact's user identifier in Telegram. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
   */
  public int|null $Id;
  /**
   * Additional data about the contact in the form of a vCard
   */
  public string|null $Vcard;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Number = $Data['contact']['phone_number'];
    $this->Name = $Data['contact']['first_name'];
    $this->NameLast = $Data['contact']['last_name'] ?? null;
    $this->Id = $Data['contact']['user_id'] ?? null;
    $this->Vcard = $Data['contact']['vcard'] ?? null;
  }
}