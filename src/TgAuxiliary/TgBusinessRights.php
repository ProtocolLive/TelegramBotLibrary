<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;

/**
 * Represents the rights of a business bot.
 * @version 2025.04.11.00
 * @link https://core.telegram.org/bots/api#businessbotrights
 */
final readonly class TgBusinessRights{
  /**
   * If the bot can send and edit messages in the private chats that had incoming messages in the last 24 hours
   */
  public bool $Reply;
  /**
   * If the bot can mark incoming private messages as read
   */
  public bool $Read;
  /**
   * If the bot can delete messages sent by the bot
   */
  public bool $DeleteBot;
  /**
   * If the bot can delete all private messages in managed chats
   */
  public bool $DeleteAll;
  /**
   * If the bot can edit the first and last name of the business account
   */
  public bool $EditName;
  /**
   * If the bot can edit the bio of the business account
   */
  public bool $EditBio;
  /**
   * If the bot can edit the profile photo of the business account
   */
  public bool $EditPhoto;
  /**
   * If the bot can edit the username of the business account
   */
  public bool $EditNick;
  /**
   * If the bot can change the privacy settings pertaining to gifts for the business account
   */
  public bool $EditPrivacy;
  /**
   * If the bot can view gifts and the amount of Telegram Stars owned by the business account
   */
  public bool $ViewGifts;
  /**
   * If the bot can convert regular gifts owned by the business account to Telegram Stars
   */
  public bool $ConvertGifts;
  /**
   * If the bot can transfer and upgrade gifts owned by the business account
   */
  public bool $TransferGifts;
  /**
   * If the bot can transfer Telegram Stars received by the business account to its own account, or use them to upgrade and transfer gifts
   */
  public bool $TransferStars;
  /**
   * If the bot can post, edit and delete stories on behalf of the business account
   */
  public bool $Stories;

  public function __construct(
    array $Data
  ){
    $this->Reply = $Data['can_reply'] ?? false;
    $this->Read = $Data['can_read_messages'] ?? false;
    $this->DeleteBot = $Data['can_delete_outgoing_messages'] ?? false;
    $this->DeleteAll = $Data['can_delete_all_messages'] ?? false;
    $this->EditName = $Data['can_edit_name'] ?? false;
    $this->EditBio = $Data['can_edit_bio'] ?? false;
    $this->EditPhoto = $Data['can_edit_profile_photo'] ?? false;
    $this->EditNick = $Data['can_edit_username'] ?? false;
    $this->EditPrivacy = $Data['can_change_gift_settings'] ?? false;
    $this->ViewGifts = $Data['can_view_gifts_and_stars'] ?? false;
    $this->ConvertGifts = $Data['can_convert_gifts_to_stars'] ?? false;
    $this->TransferGifts = $Data['can_transfer_and_upgrade_gifts'] ?? false;
    $this->TransferStars = $Data['can_transfer_stars'] ?? false;
    $this->Stories = $Data['can_manage_stories'] ?? false;
  }
}