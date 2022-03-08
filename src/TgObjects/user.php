<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.03.06.00

/**
 * @link https://core.telegram.org/bots/api#user
 */
class TgUser{
  public readonly int $Id;
  public readonly string $Name;
  public readonly bool $Bot;
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
    $this->NameLast = $Data['last_name'] ?? null;
    $this->Nick = $Data['username'] ?? null;
    $this->Language = $Data['language_code'] ?? null;
  }
}