<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgPermAdmin as TgPermAdminEnum;

/**
 * Represents a chat member that has some additional privileges.
 * @link https://core.telegram.org/bots/api#chatmemberadministrator
 * @version 2025.07.02.00
 */
final class TgPermAdmin{
  /**
   * @param bool $Manage If the administrator can access the chat event log, get boost list, see hidden supergroup and channel members, report spam messages and ignore slow mode. Implied by any other administrator privilege.
   * @param bool $Message If the administrator can post messages in the channel, or access channel statistics; for channels only
   * @param bool $Edited If the bot is allowed to edit administrator privileges of that user
   * @param bool $Edit If the administrator can edit messages of other users and can pin messages; channels only
   * @param bool $Delete If the administrator can delete messages of other users
   * @param bool $Invite If the user is allowed to invite new users to the chat
   * @param bool $Restrict If the administrator can restrict, ban or unban chat members
   * @param bool $Promote If the administrator can add new administrators with a subset of their own privileges or demote administrators that he has promoted, directly or indirectly (promoted by administrators that were appointed by the user)
   * @param bool $Video If the administrator can manage video chats
   * @param bool $Info If the administrator can change chat title, photo and other settings
   * @param bool $Pin If the user is allowed to pin messages; for groups and supergroups only
   * @param bool $Topics If the user is allowed to create, rename, close, and reopen forum topics; supergroups only,
   * @param bool $StoryCreate If the administrator can post stories in the channel; channels only
   * @param bool $StoryEdit If the administrator can edit stories posted by other users, post stories to the chat page, pin chat stories, and access the chat's story archive
   * @param bool $StoryDelete If the administrator can edit stories posted by other users; channels only
   * @link https://core.telegram.org/bots/api#chatmemberadministrator
   */
  public function __construct(
    array|null $Data = null,
    public bool $Manage = false,
    public bool $Message = false,
    public bool $Edited = true,
    public bool $Edit = false,
    public bool $Delete = false,
    public bool $Invite = false,
    public bool $Restrict = false,
    public bool $Promote = false,
    public bool $Video = false,
    public bool $Info = false,
    public bool $Pin = false,
    public bool $Topics = false,
    public bool $StoryCreate = false,
    public bool $StoryEdit = false,
    public bool $StoryDelete = false
  ){
    if($Data === null):
      return;
    endif;
    foreach(TgPermAdminEnum::cases() as $perm):
      $this->{$perm->name} = $Data[$perm->value] ?? false;
    endforeach;
  }

  public function ToArray():array{
    $return = [];
    foreach(TgPermAdminEnum::cases() as $perm):
      $return[$perm->value] = $this->{$perm->name};
    endforeach;
    return $return;
  }
}