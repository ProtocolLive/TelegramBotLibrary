<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblTraits;
use ProtocolLive\TelegramBotLibrary\TblObjects\{
  TblCurlResponse,
  TblException
};
use ProtocolLive\TelegramBotLibrary\TgEnums\TgMethods;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgSticker;

/**
 * @version 2025.05.29.00
 */
trait TblForumTrait{
  /**
   * Use this method to close an open topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_manage_topics administrator rights, unless it is the creator of the topic.
   * @param int $Chat Unique identifier for the target chat
   * @param int $Id Unique identifier for the target message thread of the forum topic
   * @return TblCurlResponse Returns True on success.
   * @link https://core.telegram.org/bots/api#closeforumtopic
   * @throws TblException
   */
  public function ForumClose(
    int $Chat,
    int $Id
  ):TblCurlResponse{
    $param['chat_id'] = $Chat;
    $param['message_thread_id'] = $Id;
    return $this->ServerMethod(TgMethods::ForumClose, $param);
  }

  /**
   * Use this method to create a topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_manage_topics administrator rights.
   * @param int $Chat Unique identifier for the target chat
   * @param string $Name Topic name, 1-128 characters
   * @param string $Color Color of the topic icon in RGB format. Currently, must be one of 0x6FB9F0, 0xFFD67E, 0xCB86DB, 0x8EEE98, 0xFF93B2, or 0xFB6F5F
   * @param string $Emoji Unique identifier of the custom emoji shown as the topic icon. Use getForumTopicIconStickers to get all allowed custom emoji identifiers.
   * @return TblCurlResponse Returns information about the created topic as a ForumTopic object.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#createforumtopic
   */
  public function ForumCreate(
    int $Chat,
    string $Name,
    string|null $Color = null,
    string|null $Emoji = null
  ):TblCurlResponse{
    $param['chat_id'] = $Chat;
    $param['name'] = $Name;
    if($Color !== null):
      $param['icon_color'] = $Color;
    endif;
    if($Emoji !== null):
      $param['icon_custom_emoji_id'] = $Emoji;
    endif;
    return $this->ServerMethod(TgMethods::ForumCreate, $param);
  }

  /**
   * Use this method to delete a forum topic along with all its messages in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_delete_messages administrator rights.
   * @param int $Chat Unique identifier for the target chat
   * @param int $Id Unique identifier for the target message thread of the forum topic
   * @return TblCurlResponse Returns True on success.
   * @link https://core.telegram.org/bots/api#deleteforumtopic
   * @throws TblException
   */
  public function ForumDelete(
    int $Chat,
    int $Id
  ):TblCurlResponse{
    $param['chat_id'] = $Chat;
    $param['message_thread_id'] = $Id;
    return $this->ServerMethod(TgMethods::ForumDel, $param);
  }

  /**
   * Use this method to edit name and icon of a topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have can_manage_topics administrator rights, unless it is the creator of the topic.
   * @param int $Chat Unique identifier for the target chat
   * @param int $Id Unique identifier for the target message thread of the forum topic
   * @param string $New topic name, 1-128 characters
   * @param string $Emoji New unique identifier of the custom emoji shown as the topic icon. Use getForumTopicIconStickers to get all allowed custom emoji identifiers
   * @return TblCurlResponse Returns True on success.
   * @link https://core.telegram.org/bots/api#editforumtopic
   * @throws TblException
   */
  public function ForumEdit(
    int $Chat,
    int $Id,
    string $Name,
    string $Emoji
  ):TblCurlResponse{
    $param['chat_id'] = $Chat;
    $param['message_thread_id'] = $Id;
    $param['name'] = $Name;
    $param['icon_custom_emoji_id'] = $Emoji;
    return $this->ServerMethod(TgMethods::ForumEdit, $param);
  }

  /**
   * Use this method to close an open 'General' topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_manage_topics administrator rights.
   * @param string $Chat Unique identifier for the target chat
   * @return TblCurlResponse Returns True on success.
   * @link https://core.telegram.org/bots/api#closegeneralforumtopic
   * @throws TblException
   */
  public function ForumGeneralClose(
    int $Chat
  ):TblCurlResponse{
    $param['chat_id'] = $Chat;
    return $this->ServerMethod(TgMethods::ForumGeneralClose, $param);
  }

  /**
   * Use this method to edit the name of the 'General' topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have can_manage_topics administrator rights.
   * @param int $Chat Unique identifier for the target chat
   * @param string $Name New topic name, 1-128 characters
   * @return TblCurlResponse Returns True on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#editgeneralforumtopic
   */
  public function ForumGeneralEdit(
    int $Chat,
    string $Name
  ):TblCurlResponse{
    $param['chat_id'] = $Chat;
    $param['name'] = $Name;
    return $this->ServerMethod(TgMethods::ForumGeneralEdit, $param);
  }

  /**
   * Use this method to hide the 'General' topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_manage_topics administrator rights. The topic will be automatically closed if it was open.
   * @param int $Chat Unique identifier for the target chat
   * @return TblCurlResponse Returns True on success.
   * @link https://core.telegram.org/bots/api#hidegeneralforumtopic
   * @throws TblException
   */
  public function ForumGeneralHide(
    int $Chat
  ):TblCurlResponse{
    $param['chat_id'] = $Chat;
    return $this->ServerMethod(TgMethods::ForumGeneralHide, $param);
  }

  /**
   * Use this method to reopen a closed 'General' topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_manage_topics administrator rights. The topic will be automatically unhidden if it was hidden.
   * @param int $Chat Unique identifier for the target chat
   * @return TblCurlResponse Returns True on success.
   * @link https://core.telegram.org/bots/api#reopengeneralforumtopic
   * @throws TblException
   */
  public function ForumGeneralReopen(
    int $Chat
  ):TblCurlResponse{
    $param['chat_id'] = $Chat;
    return $this->ServerMethod(TgMethods::ForumGeneralReopen, $param);
  }

  /**
   * Use this method to unhide the 'General' topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_manage_topics administrator rights.
   * @param int $Chat Unique identifier for the target chat
   * @return TblCurlResponse Returns True on success.
   * @link https://core.telegram.org/bots/api#unhidegeneralforumtopic
   * @throws TblException
   */
  public function ForumGeneralUnhide(
    int $Chat
  ):TblCurlResponse{
    $param['chat_id'] = $Chat;
    return $this->ServerMethod(TgMethods::ForumGeneralUnhide, $param);
  }

  /**
   * Use this method to reopen a closed topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_manage_topics administrator rights, unless it is the creator of the topic.
   * @param int $Chat Unique identifier for the target chat
   * @param int $Id Unique identifier for the target message thread of the forum topic
   * @return TblCurlResponse Returns True on success.
   * @link https://core.telegram.org/bots/api#reopenforumtopic
   * @throws TblException
   */
  public function ForumReopen(
    int $Chat,
    int $Id
  ):TblCurlResponse{
    $param['chat_id'] = $Chat;
    $param['message_thread_id'] = $Id;
    return $this->ServerMethod(TgMethods::ForumReopen, $param);
  }

  /**
   * Use this method to get custom emoji stickers, which can be used as a forum topic icon by any user. Requires no parameters.
   * @return TgSticker[] Returns an Array of Sticker objects.
   * @link https://core.telegram.org/bots/api#getforumtopiciconstickers
   * @throws TblException
   */
  public function ForumStickers():array{
    $return = $this->ServerMethod(TgMethods::ForumStickers)->Response;
    foreach($return as &$sticker):
      $sticker = new TgSticker($sticker);
    endforeach;
    return $return;
  }

  /**
   * Use this method to clear the list of pinned messages in a forum topic. The bot must be an administrator in the chat for this to work and must have the can_pin_messages administrator right in the supergroup.
   * @param int $Chat Unique identifier for the target chat
   * @param int $Id Unique identifier for the target message thread of the forum topic
   * @return TblCurlResponse Returns True on success.
   * @link https://core.telegram.org/bots/api#unpinallforumtopicmessages
   * @throws TblException
   */
  public function ForumUnpin(
    int $Chat,
    int $Id
  ):TblCurlResponse{
    $param['chat_id'] = $Chat;
    $param['message_thread_id'] = $Id;
    return $this->ServerMethod(TgMethods::ForumUnpin, $param);
  }

  /**
   * Use this method to clear the list of pinned messages in a General forum topic. The bot must be an administrator in the chat for this to work and must have the can_pin_messages administrator right in the supergroup.
   * @param string|int $Chat Unique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
   * @return TblCurlResponse Returns True on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#unpinallgeneralforumtopicmessages
   */
  public function ForumUnpinAllGeneral(
    string|int $Chat
  ):TblCurlResponse{
    $param['chat_id'] = $Chat;
    return $this->ServerMethod(TgMethods::ForumUnpinAllGeneral, $param);
  }
}