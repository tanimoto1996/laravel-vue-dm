<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function index(Request $request) {
        $user =  Auth::user();
        $userPage = $request->route()->parameter('id');
        return view('users.index', ["user" => $user, "page" => $userPage]);
    }

    public function privateMessage(Request $request, Room $room) {
        $rooms = Room::all();
        $roomsUserId = array();
        foreach ($rooms as $r) {
            $roomsUserId[$r['id']] = array($r['user_send_id'], $r['user_Receive_id']);
        }

        // roomが登録されているかを確認する
        $is​Correct = false;
        for ($i = 1; $i <= count($roomsUserId); $i++) {
            $isSendUserId = false;
            $isReceiveUserId = false;

            if($roomsUserId[$i][0] == $request->user_send_id ||
                $roomsUserId[$i][0] == $request->user_Receive_id) {
                $isSendUserId = true;
            }

            if($roomsUserId[$i][1] == $request->user_send_id ||
                $roomsUserId[$i][1] == $request->user_Receive_id) {
                    $isReceiveUserId  = true;
            }

            if($isSendUserId && $isReceiveUserId) {
                $is​Correct = true;
                break;
            }
        }

        // ルームがなかった場合、登録する
        if(!$is​Correct) {
            $room->user_send_id = $request->user_send_id;
            $room->user_Receive_id = $request->user_Receive_id;
            $room->save();
        }

        return view("users.room");
    }
}
