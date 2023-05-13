<?php
namespace App\Http\Controllers\Admin\Sample;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use TaylanUnutmaz\AgoraTokenBuilder\RtcTokenBuilder;

class VideoCallController extends Controller {
    function index(){
        return view(
            'sample.video_call',
            [
                'app_id' => 'c067d0cde328417fb1342776098f6cd6',
            ]
        );
    }

    function token(Request $request){
        $appId = 'c067d0cde328417fb1342776098f6cd6';
        $certificat_id = '57dd89d9209441249c883ec0af72e90f';
        $chanelName = 'test';
        $user_id = $request->user_id;
        $role = RtcTokenBuilder::RolePublisher;

        $expireTimeInSeconds = 3600;
        $currentTimestamp = (new \DateTime("now", new \DateTimeZone('UTC')))->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;

        $token = RtcTokenBuilder::buildTokenWithUid($appId, $certificat_id, $chanelName, $user_id, $role, $privilegeExpiredTs);

        return response()->json([
            'data' => $request->all(),
            'token' => $token,
            'appId' => $appId,
            'channelName' => $chanelName,
            'user_id' => $user_id
        ]);
    }

}