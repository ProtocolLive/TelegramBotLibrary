<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.06.21.00
//API 6.1

/**
 * @link https://core.telegram.org/bots/api#user
 */
class TgUser{
  public readonly int $Id;
  public readonly string $Name;
  public readonly bool $Bot;
  public readonly bool $Premium;
  public readonly bool $Attached;
  public readonly string|null $NameLast;
  public readonly string|null $Nick;
  public readonly string|null $Language;

  /**
   * @link https://core.telegram.org/bots/api#user
   */
  public function __construct(array $Data){
    $this->Id = $Data['id'];
    $this->Name = $Data['first_name'];
    $this->Bot = $Data['is_bot'] ?? false;
    $this->Premium = $Data['is_premium'] ?? false;
    $this->Attached = $Data['added_to_attachment_menu'] ?? false;
    $this->NameLast = $Data['last_name'] ?? null;
    $this->Nick = $Data['username'] ?? null;
    $this->Language = $Data['language_code'] ?? null;
  }
}