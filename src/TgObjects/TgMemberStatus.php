<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

enum TgMemberStatus:string{
  /**
   * Represents a chat member that owns the chat and has all administrator privileges.
   * @link https://core.telegram.org/bots/api#chatmemberowner
   */
  case Creator = 'creator';
  /**
   * Represents a chat member that has some additional privileges.
   * @link https://core.telegram.org/bots/api#chatmemberadministrator
   */
  case Adm = 'administrator';
  /**
   * Represents a chat member that has no additional privileges or restrictions.
   * @link https://core.telegram.org/bots/api#chatmembermember
   */
  case Member = 'member';
  /**
   * Represents a chat member that is under certain restrictions in the chat. Supergroups only.
   * @link https://core.telegram.org/bots/api#chatmemberrestricted
   */
  case Restricted = 'restricted';
  /**
   * Represents a chat member that isn't currently a member of the chat, but may join it themselves.
   * @link https://core.telegram.org/bots/api#chatmemberleft
   */
  case Left = 'left';
  /**
   * Represents a chat member that was banned in the chat and can't return to the chat or view chat messages.
   * @link https://core.telegram.org/bots/api#chatmemberbanned
   */
  case Banned = 'kicked';
}