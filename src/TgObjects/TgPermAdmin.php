<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.02.03.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#chatmemberadministrator
 */
class TgPermAdmin{
  const Array = [
    'Manage' => 'can_manage_chat',
    'Message' => 'can_post_messages',
    'Edit' => 'can_edit_messages',
    'Delete' => 'can_delete_messages',
    'Invite' => 'can_invite_users',
    'Restrict' => 'can_restrict_members',
    'Promote' => 'can_promote_members',
    'Video' => 'can_manage_video_chats',
    'Info' => 'can_change_info',
    'Pin' => 'can_pin_messages',
    'Topics' => 'can_manage_topics'
  ];

  /**
   * @param bool $Manage If the administrator can access the chat event log, chat statistics, message statistics in channels, see channel members, see anonymous administrators in supergroups and ignore slow mode. Implied by any other administrator privilege
   * @param bool $Message If the administrator can post in the channel; channels only
   * @param bool $Edited If the bot is allowed to edit administrator privileges of that user
   * @param bool $Edit If the administrator can edit messages of other users and can pin messages; channels only
   * @param bool $Delete If the administrator can delete messages of other users
   * @param bool $Invite If the user is allowed to invite new users to the chat
   * @param bool $Restrict If the administrator can restrict, ban or unban chat members
   * @param bool $Promote If the administrator can add new administrators with a subset of their own privileges or demote administrators that he has promoted, directly or indirectly (promoted by administrators that were appointed by the user)
   * @param bool $Video If the administrator can manage video chats
   * @param bool $Info If the administrator can change chat title, photo and other settings
   * @param bool $Pin If the administrator can pin messages, supergroups only
   * @param bool $Topics If the user is allowed to create, rename, close, and reopen forum topics; supergroups only
   * @link https://core.telegram.org/bots/api#chatmemberadministrator
   */
  public function __construct(
    array $Data = null,
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
    public bool $Topics = false
  ){
    if($Data !== null):
      foreach(self::Array as $perm => $vector):
        $this->$perm = $Data[$vector] ?? false;
      endforeach;
    endif;
  }

  public function ToArray():array{
    $return = [];
    foreach(self::Array as $perm => $vector):
      $return[$vector] = $this->$perm;
    endforeach;
    return $return;
  }
}