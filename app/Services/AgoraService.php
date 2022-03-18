<?php
namespace App\Services;

use TaylanUnutmaz\AgoraTokenBuilder\RtcTokenBuilder;

class AgoraService {
    static function token(string $chanelName, $user_id){
        $appId = config('services.agora.app_id');
        $certificat_id = config('services.agora.certificate_id');
        $role = RtcTokenBuilder::RolePublisher;

        $expireTimeInSeconds = 3600;
        $currentTimestamp = (new \DateTime("now", new \DateTimeZone('UTC')))->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;

        $token = RtcTokenBuilder::buildTokenWithUid($appId, $certificat_id, $chanelName, $user_id, $role, $privilegeExpiredTs);

        return [
            'token' => $token,
            'appId' => $appId,
            'channelName' => $chanelName,
            'user_id' => $user_id
        ];
    }

}
