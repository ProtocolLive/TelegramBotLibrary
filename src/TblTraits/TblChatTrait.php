<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblTraits;
use CURLFile;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblException;
use ProtocolLive\TelegramBotLibrary\TgEnums\{
  TgChatAction,
  TgChatType,
  TgMethods
};
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgChat,
  TgChatBoost,
  TgChatInviteLink,
  TgMember,
  TgPermAdmin,
  TgPermMember,
  TgUser
};

/**
 * @version 2024.11.11.01
 */
trait TblChatTrait{
  /**
   * Use this method when you need to tell the user that something is happening on the bot's side. The status is set for 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status).
   * Example: The ImageBot needs some time to process a request and upload the image. Instead of sending a text message along the lines of “Retrieving image, please wait…”, the bot may use sendChatAction with action = upload_photo. The user will see a “sending photo” status for the bot.
   * @param int|string $Chat Unique identifier for the target chat or username of the target supergroup or channel (in the format @channelusername)
   * @param TgChatAction $Action Type of action to broadcast.
   * @param int $Thread Unique identifier for the target message thread; supergroups only
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the action will be sent
   * @return bool Returns True on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#sendchataction
   */
  public function ChatActionSend(
    int|string $Chat,
    TgChatAction $Action,
    int $Thread = null,
    string $BusinessId = null
  ):bool{
    $param['chat_id'] = $Chat;
    $param['action'] = $Action->value;
    if($BusinessId !== null):
      $param['business_connection_id'] = $BusinessId;
    endif;
    if($Thread !== null):
      $param['message_thread_id'] = $Chat;
    endif;
    return $this->ServerMethod(TgMethods::ChatAction, $param);
  }

  /**
   * Use this method to get a list of administrators in a chat. On success
   * @param int|string $Chat Unique identifier for the target chat or username of the target supergroup or channel (in the format @channelusername)
   * @return TgMember[] Returns an Array of ChatMember objects that contains information about all chat administrators except other bots.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#getchatadministrators
   */
  public function ChatAdmGet(
    int|string $Chat
  ):array{
    $param['chat_id'] = $Chat;
    $temp = $this->ServerMethod(TgMethods::ChatAdms, $param);
    $return = [];
    foreach($temp as $user):
      $return[] = new TgMember($user);
    endforeach;
    return $return;
  }

  /**
   * Use this method to promote or demote a user in a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Pass False for all boolean parameters to demote a user.
   * @param int|string $Chat Unique identifier for the target chat or username of the target supergroup or channel (in the format @channelusername)
   * @param int $User Unique identifier of the target user
   * @param bool $Anonymous If the administrator's presence in the chat is hidden
   * @return true Returns True on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#promotechatmember
   */
  public function ChatAdminPerm(
    int|string $Chat,
    int $User,
    TgPermAdmin $Perms,
    bool $Anonymous = false
  ):true{
    $param['chat_id'] = $Chat;
    $param['user_id'] = $User;
    foreach(TgPermAdmin::Array as $class => $json):
      $param[$json] = $Perms->$class ? true : false;
    endforeach;
    $param['is_anonymous'] = $Anonymous ? true : false;
    return $this->ServerMethod(TgMethods::ChatMemberPromote, $param);
  }

  /**
   * Use this method to set a custom title for an administrator in a supergroup promoted by the bot.
   * @param int|string $Chat Unique identifier for the target chat or username of the target supergroup or channel (in the format @channelusername)
   * @param int $User Unique identifier of the target user
   * @param string $Title New custom title for the administrator; 0-16 characters, emoji are not allowed
   * @return bool Returns True on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#setchatadministratorcustomtitle
   */
  public function ChatAdminTitleSet(
    int|string $Chat,
    int $User,
    string $Title
  ):bool{
    $param['chat_id'] = $Chat;
    $param['user_id'] = $User;
    $param['custom_title'] = $Title;
    return $this->ServerMethod(TgMethods::ChatAdmTitle, $param);
  }

  /**
   * Use this method to ban a user in a group, a supergroup or a channel. In the case of supergroups and channels, the user will not be able to return to the chat on their own using invite links, etc., unless unbanned first. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights.
   * @param int|string $Chat Unique identifier for the target chat or username of the target supergroup or channel (in the format @channelusername)
   * @param int $User Unique identifier of the target user
   * @param int $Date Date when the user will be unbanned, unix time. If user is banned for more than 366 days or less than 30 seconds from the current time they are considered to be banned forever. Applied for supergroups and channels only.
   * @param bool $DelMsg Pass True to delete all messages from the chat for the user that is being removed. If False, the user will be able to see messages in the group that were sent before the user was removed. Always True for supergroups and channels.
   * @return bool Returns True on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#banchatmember
   */
  public function ChatBan(
    int|string $Chat,
    int $User,
    int $Date,
    bool $DelMsg = false
  ):bool{
    $param['chat_id'] = $Chat;
    $param['user_id'] = $User;
    $param['until_date'] = $Date;
    $param['revoke_messages'] = $DelMsg;
    return $this->ServerMethod(TgMethods::ChatMemberBan, $param);
  }

  /**
   * Use this method to ban a channel chat in a supergroup or a channel. Until the chat is unbanned, the owner of the banned chat won't be able to send messages on behalf of any of their channels. The bot must be an administrator in the supergroup or channel for this to work and must have the appropriate administrator rights.
   * @param string|int $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param int $SenderChat Unique identifier of the target sender chat
   * @return true on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#banchatsenderchat
   */
  public function ChatBanChannel(
    string|int $Chat,
    int $SenderChat
  ):true{
    $param['chat_id'] = $Chat;
    $param['sender_chat_id'] = $SenderChat;
    return $this->ServerMethod(TgMethods::ChatBanChannel, $param);
  }

  /**
   * Use this method to unban a previously banned user in a supergroup or channel. The user will not return to the group or channel automatically, but will be able to join via link, etc. The bot must be an administrator for this to work. By default, this method guarantees that after the call the user is not a member of the chat, but will be able to join it. So if the user is a member of the chat they will also be removed from the chat. If you don't want this, use the parameter only_if_banned.
   * @param int|string $Chat Unique identifier for the target chat or username of the target supergroup or channel (in the format @channelusername)
   * @param int $User Unique identifier of the target user
   * @param bool $OnlyIfBanned Do nothing if the user is not banned
   * @return bool Returns True on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#unbanchatmember
   */
  public function ChatBanUndo(
    int|string $Chat,
    int $User,
    bool $OnlyIfBanned = true
  ):bool{
    $param['chat_id'] = $Chat;
    $param['user_id'] = $User;
    $param['only_if_banned'] = $OnlyIfBanned;
    return $this->ServerMethod(TgMethods::ChatMemberBanUndo, $param);
  }

  /**
   * Use this method to unban a previously banned channel chat in a supergroup or channel. The bot must be an administrator for this to work and must have the appropriate administrator rights.
   * @param string|int $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param int $SenderChat Unique identifier of the target sender chat
   * @return true on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#unbanchatsenderchat
   */
  public function ChatBanUndoChannel(
    string|int $Chat,
    int $SenderChat
  ):true{
    $param['chat_id'] = $Chat;
    $param['sender_chat_id'] = $SenderChat;
    return $this->ServerMethod(TgMethods::ChatBanChannelUndo, $param);
  }

  /**
   * Use this method to get the list of boosts added to a chat by a user. Requires administrator rights in the chat. Returns a UserChatBoosts object.
   * @param int|string $Chat Unique identifier for the chat or username of the channel (in the format @channelusername)
   * @param int $User Unique identifier of the target user
   * @return TgChatBoost[]
   * @link https://core.telegram.org/bots/api#getuserchatboosts
   */
  public function ChatBoostGet(
    int|string $Chat,
    int $User
  ):array{
    $param['chat_id'] = $Chat;
    $param['user_id'] = $User;
    $temp = $this->ServerMethod(TgMethods::ChatBoosterGet, $param);
    $return = [];
    foreach($temp['boosts'] as $boost):
      $return[] = new TgChatBoost($boost);
    endforeach;
    return $return;
  }

  /**
   * Use this method to get the number of members in a chat.
   * @param int|string $Chat Unique identifier for the target chat or username of the target supergroup or channel (in the format @channelusername)
   * @param int Returns Int on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#getchatmembercount
   */
  public function ChatCount(
    int|string $Chat
  ):int{
    $param['chat_id'] = $Chat;
    return $this->ServerMethod(TgMethods::ChatMemberCount, $param);
  }

  /**
   * Use this method to change the description of a group, a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param string $Description New chat description, 0-255 characters
   * @return true Returns True on success.
   * @link https://core.telegram.org/bots/api#setchatdescription
   */
  public function ChatDescription(
    int|string $Chat,
    string $Description
  ):true{
    $param['chat_id'] = $Chat;
    $param['description'] = $Description;
    return $this->ServerMethod(TgMethods::ChatDescription, $param);
  }

  /**
   * Use this method to get up to date information about the chat (current name of the user for one-on-one conversations, current username of a user, group or channel, etc.).
   * @param int|string $Chat Unique identifier for the target chat or username of the target supergroup or channel (in the format @channelusername)
   * @return TgChat|TgUser Returns a Chat object on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#getchat
   */
  public function ChatGet(
    int|string $Chat
  ):TgChat|TgUser{
    $param['chat_id'] = $Chat;
    $temp = $this->ServerMethod(TgMethods::Chat, $param);
    if($temp['type'] === TgChatType::Private->value):
      return new TgUser($temp);
    else:
      return new TgChat($temp);
    endif;
  }

  /**
   * Use this method to create an additional invite link for a chat. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. The link can be revoked using the method revokeChatInviteLink.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param string $Name Invite link name; 0-32 characters
   * @param int $Expire Point in time (Unix timestamp) when the link will expire
   * @param int $Limit The maximum number of users that can be members of the chat simultaneously after joining the chat via this invite link; 1-99999
   * @param bool $NeedApproval If users joining the chat via the link need to be approved by chat administrators. If True, member_limit can't be specified
   * @return TgChatInviteLink Returns the new invite link as ChatInviteLink object.
   * @link https://core.telegram.org/bots/api#createchatinvitelink
   */
  public function ChatInviteCreate(
    int|string $Chat,
    string $Name = null,
    int $Expire = null,
    int $Limit = 0,
    bool $NeedApproval = false
  ):TgChatInviteLink{
    $param['chat_id'] = $Chat;
    if($Name !== null):
      $param['name'] = $Name;
    endif;
    if($Expire !== null):
      $param['expire_date'] = $Expire;
    endif;
    if($Limit > 0):
      $param['member_limit'] = $Limit;
    endif;
    if($NeedApproval):
      $param['creates_join_request'] = true;
    endif;
    return new TgChatInviteLink($this->ServerMethod(TgMethods::ChatInviteLinkCreate, $param));
  }

  /**
   * Use this method to revoke an invite link created by the bot. If the primary link is revoked, a new link is automatically generated. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights.
   * @param int|string $Chat Unique identifier of the target chat or username of the target channel (in the format @channelusername)
   * @param string $Link The invite link to revoke
   * @return TgChatInviteLink Returns the revoked invite link as ChatInviteLink object.
   * @link https://core.telegram.org/bots/api#revokechatinvitelink
   */
  public function ChatInviteDel(
    int|string $Chat,
    string $Link
  ):TgChatInviteLink{
    $param['chat_id'] = $Chat;
    $param['invite_link'] = $Link;
    return new TgChatInviteLink($this->ServerMethod(TgMethods::ChatInviteLinkDel, $param));
  }

  /**
   * Use this method to edit a non-primary invite link created by the bot. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param string $Link The invite link to edit
   * @param string $Name Invite link name; 0-32 characters
   * @param int $Expire Point in time (Unix timestamp) when the link will expire
   * @param int $Limit The maximum number of users that can be members of the chat simultaneously after joining the chat via this invite link; 1-99999
   * @param bool $NeedApproval If users joining the chat via the link need to be approved by chat administrators. If True, member_limit can't be specified
   * @return TgChatInviteLink Returns the edited invite link as a ChatInviteLink object.
   * @link https://core.telegram.org/bots/api#editchatinvitelink
   */
  public function ChatInviteEdit(
    int|string $Chat,
    string $Link,
    string $Name = null,
    int $Expire = null,
    int $Limit = 0,
    bool $NeedApproval = false
  ):TgChatInviteLink{
    $param['chat_id'] = $Chat;
    $param['invite_link'] = $Link;
    if($Name !== null):
      $param['name'] = $Name;
    endif;
    if($Expire !== null):
      $param['expire_date'] = $Expire;
    endif;
    if($Limit > 0):
      $param['member_limit'] = $Limit;
    endif;
    if($NeedApproval):
      $param['creates_join_request'] = true;
    endif;
    return new TgChatInviteLink($this->ServerMethod(TgMethods::ChatInviteLinkEdit, $param));
  }

  /**
   * Use this method to generate a new primary invite link for a chat; any previously generated primary link is revoked. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Note: Each administrator in a chat generates their own invite links. Bots can't use invite links generated by other administrators. If you want your bot to work with invite links, it will need to generate its own link using exportChatInviteLink or by calling the getChat method. If your bot needs to generate a new primary invite link replacing its previous one, use exportChatInviteLink again.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @return string Returns the new invite link as String on success.
   * @link https://core.telegram.org/bots/api#exportchatinvitelink
   */
  public function ChatInvitePrimary(
    int|string $Chat
  ):string{
    $param['chat_id'] = $Chat;
    return $this->ServerMethod(TgMethods::ChatInviteExport, $param);
  }

  /**
   * Use this method to approve a chat join request. The bot must be an administrator in the chat for this to work and must have the can_invite_users administrator right.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param int $User Unique identifier of the target user
   * @return true Returns True on success.
   */
  public function ChatJoinAprove(
    int|string $Chat,
    int $User
  ):true{
    $param['chat_id'] = $Chat;
    $param['user_id'] = $User;
    return $this->ServerMethod(TgMethods::ChatJoinApprove, $param);
  }

  /**
   * Use this method to decline a chat join request. The bot must be an administrator in the chat for this to work and must have the can_invite_users administrator right.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param int $User Unique identifier of the target user
   * @return true Returns True on success.
   * @link https://core.telegram.org/bots/api#declinechatjoinrequest
   */
  public function ChatJoinDecline(
    int|string $Chat,
    int $User
  ):true{
    $param['chat_id'] = $Chat;
    $param['user_id'] = $User;
    return $this->ServerMethod(TgMethods::ChatJoinDecline, $param);
  }

  /**
   * Use this method for your bot to leave a group, supergroup or channel.
   * @param int|string $Chat Unique identifier for the target chat or username of the target supergroup or channel (in the format @channelusername)
   * @return true Returns True on success.
   * @link https://core.telegram.org/bots/api#leavechat
   */
  public function ChatLeave(
    int|string $Chat
  ):true{
    $param['chat_id'] = $Chat;
    return $this->ServerMethod(TgMethods::ChatLeave, $param);
  }

  /**
   * Use this method to get information about a member of a chat.
   * @param int|string $Chat Unique identifier for the target chat or username of the target supergroup or channel (in the format @channelusername)
   * @param int $User Unique identifier of the target user
   * @return TgMember Returns a ChatMember object on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#getchatmember
   */
  public function ChatMember(
    int|string $Chat,
    int $User
  ):TgMember{
    $param['chat_id'] = $Chat;
    $param['user_id'] = $User;
    $temp = $this->ServerMethod(TgMethods::ChatMember, $param);
    return new TgMember($temp);
  }

  /**
   * Use this method to restrict a user in a supergroup. The bot must be an administrator in the supergroup for this to work and must have the appropriate administrator rights. Pass True for all permissions to lift restrictions from a user.
   * @param int|string $Chat Unique identifier for the target chat or username of the target supergroup or channel (in the format @channelusername)
   * @param int $User Unique identifier of the target user
   * @param TgPermMember $Perms A object for new user permissions
   * @param int $Period Date when restrictions will be lifted for the user, unix time. If user is restricted for more than 366 days or less than 30 seconds from the current time, they are considered to be restricted forever
   * @param bool $Independent Pass True if chat permissions are set independently. Otherwise, the can_send_other_messages and can_add_web_page_previews permissions will imply the can_send_messages, can_send_audios, can_send_documents, can_send_photos, can_send_videos, can_send_video_notes, and can_send_voice_notes permissions; the can_send_polls permission will imply the can_send_messages permission.
   * @return bool Returns True on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#restrictchatmember
   */
  public function ChatMemberPerm(
    int|string $Chat,
    int $User,
    TgPermMember $Perms,
    int $Period = null,
    bool $Independent = false
  ):bool{
    $param['chat_id'] = $Chat;
    $param['user_id'] = $User;
    $param['permissions'] = $Perms->ToArray();
    $param['until_date'] = $Period;
    if($Independent):
      $param['use_independent_chat_permissions'] = true;
    endif;
    return $this->ServerMethod(TgMethods::ChatMemberPerm, $param);
  }

  /**
   * Use this method to set default chat permissions for all members. The bot must be an administrator in the group or a supergroup for this to work and must have the can_restrict_members administrator rights.
   * @param int|string $Chat Unique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
   * @param TgPermMember $Perms A JSON-serialized object for new default chat permissions
   * @param bool $Independent Pass True if chat permissions are set independently. Otherwise, the can_send_other_messages and can_add_web_page_previews permissions will imply the can_send_messages, can_send_audios, can_send_documents, can_send_photos, can_send_videos, can_send_video_notes, and can_send_voice_notes permissions; the can_send_polls permission will imply the can_send_messages permission.
   * @return bool Returns True on success.
   * @link https://core.telegram.org/bots/api#setchatpermissions
   * @throws TblException
   */
  public function ChatPerm(
    int|string $Chat,
    TgPermMember $Perms,
    bool $Independent = false
  ):bool{
    $params['chat_id'] = $Chat;
    $params['permissions'] = $Perms->ToArray();
    if($Independent):
      $params['use_independent_chat_permissions'] = true;
    endif;
    return parent::ServerMethod(TgMethods::ChatPerm, $params);
  }

  /**
   * Use this method to delete a chat photo. Photos can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @return true Returns True on success.
   * @link https://core.telegram.org/bots/api#deletechatphoto
   */
  public function ChatPhotoDel(
    int|string $Chat
  ):true{
    $param['chat_id'] = $Chat;
    return $this->ServerMethod(TgMethods::ChatPhotoDel, $param);
  }

  /**
   * Use this method to set a new profile photo for the chat. Photos can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param string $Photo New chat photo, uploaded using multipart/form-data
   * @return true Returns True on success.
   * @link https://core.telegram.org/bots/api#setchatphoto
   */
  public function ChatPhotoSet(
    int|string $Chat,
    string $Photo
  ):true{
    $param['chat_id'] = $Chat;
    if(is_file($Photo)):
      $param['photo'] = new CURLFile($Photo);
    else:
      $param['photo'] = $Photo;
    endif;
    return $this->ServerMethod(TgMethods::ChatPhotoSet, $param);
  }

  /**
   * Use this method to change the title of a chat. Titles can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param string $Title New chat title, 1-128 characters
   * @return true Returns True on success.
   * @link https://core.telegram.org/bots/api#setchattitle
   */
  public function ChatName(
    int|string $Chat,
    string $Name
  ):true{
    $param['chat_id'] = $Chat;
    $param['title'] = $Name;
    return $this->ServerMethod(TgMethods::ChatTitle, $param);
  }
}