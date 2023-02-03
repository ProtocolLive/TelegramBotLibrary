<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.02.03.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#chatpermissions
 */
class TgPermMember{
  const Array = [
    'Message' => 'can_send_messages',
    'Media' => 'can_send_media_messages',
    'Audio' => 'can_send_audios',
    'Documents' => 'can_send_documents',
    'Photos' => 'can_send_photos',
    'Videos' => 'can_send_videos',
    'VideoNote' => 'can_send_video_notes',
    'VoiceNote' => 'can_send_voice_notes',
    'Poll' => 'can_send_polls',
    'Media2' => 'can_send_other_messages',
    'Preview' => 'can_add_web_page_previews',
    'Info' => 'can_change_info',
    'Invite' => 'can_invite_users',
    'Pin' => 'can_pin_messages',
    'Topics' => 'can_manage_topics'
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
   * @param bool $Topics If the user is allowed to create, rename, close, and reopen forum topics; supergroups only
   * @link https://core.telegram.org/bots/api#chatpermissions
   */
  public function __construct(
    array $Data = null,
    bool $Message = false,
    bool $Media = false,
    bool $Audio = false,
    bool $Documents = false,
    bool $Photos = false,
    bool $Videos = false,
    bool $VideoNote = false,
    bool $VoiceNote = false,
    bool $Poll = false,
    bool $Media2 = false,
    bool $Preview = false,
    bool $Info = false,
    bool $Invite = false,
    bool $Pin = false,
    bool $Topics = false
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