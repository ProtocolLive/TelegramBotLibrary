<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.11.05.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#chatpermissions
 */
class TgPermMember{
  const Array = [
    'Message' => 'can_send_messages',
    'Media' => 'can_send_media_messages',
    'Poll' => 'can_send_polls',
    'Media2' => 'can_send_other_messages',
    'Preview' => 'can_add_web_page_previews',
    'Info' => 'can_change_info',
    'Invite' => 'can_invite_users',
    'Pin' => 'can_pin_messages',
    'Forum' => 'can_manage_topics'
  ];

  /**
   * Describes actions that a non-administrator user is allowed to take in a chat.
   * @param bool $Message If the user is allowed to send text messages, contacts, locations and venues
   * @param bool $Media If the user is allowed to send audios, documents, photos, videos, video notes and voice notes, implies can_send_messages
   * @param bool $Poll If the user is allowed to send polls, implies can_send_messages
   * @param bool $Media2 If the user is allowed to send animations, games, stickers and use inline bots, implies $Media
   * @param bool $Preview If the user is allowed to add web page previews to their messages, implies $Media
   * @param bool $Info If the user is allowed to change the chat title, photo and other settings. Ignored in public supergroups
   * @param bool $Invite If the user is allowed to invite new users to the chat
   * @param bool $Pin If the user is allowed to pin messages. Ignored in public supergroups
   * @param bool $Forum If the user is allowed to create, rename, close, and reopen forum topics; supergroups only
   * @link https://core.telegram.org/bots/api#chatpermissions
   */
  public function __construct(
    array $Data = null,
    public bool $Message = false,
    public bool $Media = false,
    public bool $Poll = false,
    public bool $Media2 = false,
    public bool $Preview = false,
    public bool $Info = false,
    public bool $Invite = false,
    public bool $Pin = false,
    public bool $Forum = false
  ){
    if($Data !== null):
      foreach(self::Array as $perm => $vector):
        $this->$perm = $Data[$vector] ?? false;
      endforeach;
    endif;
  }
}