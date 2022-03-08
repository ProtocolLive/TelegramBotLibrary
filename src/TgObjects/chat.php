<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.03.06.00

enum TgChatType:string{
  case Private = 'private';
  case Group = 'group';
  case GroupSuper = 'supergroup';
  case Channel = 'channel';
}

/**
 * @link https://core.telegram.org/bots/api#chat
 */
class TgChat{
  public readonly int $Id;
  public readonly string $Name;
  public readonly TgChatType $Type;
  public readonly string|null $NameLast;
  public readonly string|null $Nick;

  public function __construct(array $Data){
    $this->Id = $Data['id'];
    $this->Name = $Data['title'] ?? $Data['first_name'];
    $this->Type = TgChatType::tryFrom($Data['type']);
    $this->NameLast = $Data['last_name'] ?? null;
    $this->Nick = $Data['username'] ?? null;
  }
}