<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.03.07.00

class TblWebhook extends TblBasics{
  public function __construct(TblData $BotData){
    $this->BotData = $BotData;
  }

  /**
   * @param string $Url HTTPS url to send updates to.
   * @param string $ServerIp The fixed IP address which will be used to send webhook requests instead of the IP address resolved through DNS
   * @param int $MaxConnections Maximum allowed number of simultaneous HTTPS connections to the webhook for update delivery, 1-100. Defaults to 40. Use lower values to limit the load on your bot's server, and higher values to increase your bot's throughput.
   * @link https://core.telegram.org/bots/api#setwebhook
   */
  public function Set(
    string $Url,
    string $ServerIp = null,
    int $MaxConnections = null,
    array $Updates = null
  ):bool|null{
    $param['url'] = $Url;
    if($ServerIp !== null):
      $param['ip_address'] = $ServerIp;
    endif;
    if($MaxConnections !== null):
      $param['max_connections'] = $MaxConnections;
    endif;
    if($Updates !== null):
      $Updates = array_map(function ($update){
          return TgUpdateType::tryFrom($update);
        },
        $Updates
      );
      $param['allowed_updates'] = json_encode($Updates);
    endif;
    return $this->ServerMethod('setWebhook?' . http_build_query($param));
  }

  /**
   * @link https://core.telegram.org/bots/api#getwebhookinfo
   */
  public function Get():array{
    return $this->ServerMethod('getWebhookInfo');
  }

  /**
   * @param bool $Drop True to drop all pending updates
   * @link https://core.telegram.org/bots/api#deletewebhook
   */
  public function Del(bool $Drop = false):bool{
    $temp = 'deleteWebhook';
    if($Drop):
      $temp .= '?drop_pending_updates=true';
    endif;
    return $this->ServerMethod($temp);
  }
}