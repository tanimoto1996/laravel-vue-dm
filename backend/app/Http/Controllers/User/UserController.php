<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Message;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function index(Request $request) {
        $user =  Auth::user();
        $userPage = $request->route()->parameter('id');
        return view('users.index', ["user" => $user, "page" => $userPage]);
    }

    public function privateMessage(Request $request, Room $room) {
        $user_send_id = $request->user_send_id;
        $user_Receive_id = $request->user_Receive_id;

        $rooms = Room::all();
        $roomsUserId = array();
        foreach ($rooms as $r) {
            $roomsUserId[$r['id']] = array($r['user_send_id'], $r['user_Receive_id']);
        }

        // roomが登録されているかを確認する
        $is​Correct = false;
        foreach ($roomsUserId as $key => $val) {
            $isSendUserId = false;
            $isReceiveUserId = false;

            if($val[0] == $user_send_id ||
                $val[1] == $user_send_id) {
                $isSendUserId = true;
            }

            if($val[0] == $user_Receive_id ||
                $val[1] == $user_Receive_id) {
                    $isReceiveUserId  = true;
            }

            if($isSendUserId && $isReceiveUserId) {
                $is​Correct = true;
                break;
            }
        }
        
        if(!$is​Correct) {
            // ルームがなかった場合、登録する
            $room->user_send_id = $user_send_id;
            $room->user_Receive_id = $user_Receive_id;
            $room->save();
            return view("users.room", ['user_send_id' => $user_send_id, 'user_Receive_id' => $user_Receive_id]);
        } else {

            $query =  Room::where(function($query) use($user_send_id, $user_Receive_id){
                $query->orWhere('user_send_id', '=', $user_send_id)
                        ->orWhere('user_send_id', '=', $user_Receive_id);
            })->where(function($query) use($user_send_id, $user_Receive_id){
                $query->orWhere('user_Receive_id', '=', $user_send_id)
                        ->orWhere('user_Receive_id', '=', $user_Receive_id);
            })->first()->toArray();
    
            $roomMessage = DB::table('messages')
                        ->where('rooms_id', '=', $query['id'])
                        ->get();

            // ルームがあった場合、チャットを表示する
            return view("users.room", ['user_send_id' => $user_send_id, 'user_Receive_id' => $user_Receive_id, 'roomMessage' => $roomMessage]);
        }
        
    }

    public function addMessage(Request $request, Message $message, Room $room) {
        $user_send_id = $request->user_send_id;
        $user_Receive_id = $request->user_Receive_id;

        $query =  Room::where(function($query) use($user_send_id, $user_Receive_id){
            $query->orWhere('user_send_id', '=', $user_send_id)
                    ->orWhere('user_send_id', '=', $user_Receive_id);
        })->where(function($query) use($user_send_id, $user_Receive_id){
            $query->orWhere('user_Receive_id', '=', $user_send_id)
                    ->orWhere('user_Receive_id', '=', $user_Receive_id);
        })->first()->toArray();

        $roomMessage = DB::table('messages')
        ->where('rooms_id', '=', $query['id'])
        ->get();
        $message->text = $request->text;
        $message->user_send_id = $request->user_send_id;
        $message->rooms_id = $query['id'];
        $message->save();
        return view("users.room", ['user_send_id' => $user_send_id, 'user_Receive_id' => $user_Receive_id, 'roomMessage' => $roomMessage]);
    }

}
