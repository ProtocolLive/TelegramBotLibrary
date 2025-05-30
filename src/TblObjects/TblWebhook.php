<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use CURLFile;
use ProtocolLive\TelegramBotLibrary\TgEnums\{
  TgMethods,
  TgUpdateType
};

/**
 * @version 2025.05.29.01
 */
final class TblWebhook
extends TblBasics{
  public function __construct(
    TblData $BotData
  ){
    $this->BotData = $BotData;
  }

  /**
   * Use this method to specify a url and receive incoming updates via an outgoing webhook. Whenever there is an update for the bot, we will send an HTTPS POST request to the specified url, containing a JSON-serialized Update. In case of an unsuccessful request, we will give up after a reasonable amount of attempts. If you'd like to make sure that the Webhook request comes from Telegram, we recommend using a secret path in the URL, e.g. https://www.example.com/<token>. Since nobody else knows your bot's token, you can be pretty sure it's us.
   * @param string $Url HTTPS url to send updates to. Use an empty string to remove webhook integration
   * @param string $ServerIp The fixed IP address which will be used to send webhook requests instead of the IP address resolved through DNS
   * @param int $MaxConnections Maximum allowed number of simultaneous HTTPS connections to the webhook for update delivery, 1-100. Defaults to 40. Use lower values to limit the load on your bot's server, and higher values to increase your bot's throughput.
   * @param TgUpdateType[] $Updates A list of the update types you want your bot to receive. For example, specify [“message”, “edited_channel_post”, “callback_query”] to only receive updates of these types. See Update for a complete list of available update types. Specify an empty list to receive all update types except chat_member (default). If not specified, the previous setting will be used. Please note that this parameter doesn't affect updates created before the call to the setWebhook, so unwanted updates may be received for a short period of time.
   * @param string $Certificate Upload your public key certificate so that the root certificate in use can be checked. See our self-signed guide for details.
   * @param string $TokenWebhook A secret token to be sent in a header “X-Telegram-Bot-Api-Secret-Token” in every webhook request, 1-256 characters. Only characters A-Z, a-z, 0-9, _ and - are allowed. The header is useful to ensure that the request comes from a webhook set by you.
   * @return TblCurlResponse True on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#setwebhook
   */
  public function Set(
    string $Url,
    string|null $ServerIp = null,
    int|null $MaxConnections = null,
    array|null $Updates = null,
    string|null $Certificate = null,
    string|null $TokenWebhook = null
  ):TblCurlResponse{
    $param['url'] = $Url;
    if($ServerIp !== null):
      $param['ip_address'] = $ServerIp;
    endif;
    if($MaxConnections !== null):
      $param['max_connections'] = $MaxConnections;
    endif;
    if($Updates !== null):
      foreach($Updates as $update):
        $param['allowed_updates'][] = $update->value;
      endforeach;
    endif;
    if($Certificate !== null):
      $param['certificate'] = new CURLFile($Certificate);
    endif;
    if(empty($TokenWebhook) === false):
      $param['secret_token'] = $TokenWebhook;
    endif;
    return $this->ServerMethod(TgMethods::WebhookSet, $param);
  }

  /**
   * @throws TblException
   * @link https://core.telegram.org/bots/api#getwebhookinfo
   */
  public function Get():TblCurlResponse{
    return $this->ServerMethod(TgMethods::WebhookGet);
  }

  /**
   * @param bool $Drop True to drop all pending updates
   * @throws TblException
   * @link https://core.telegram.org/bots/api#deletewebhook
   */
  public function Del(
    bool $Drop = false
  ):TblCurlResponse{
    $param = [];
    if($Drop):
      $param['drop_pending_updates'] = true;
    endif;
    return $this->ServerMethod(TgMethods::WebhookDel, $param);
  }
}