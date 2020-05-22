<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Alertcomment;
use App\Alert;
use App\User;
use App\Http\Requests\StoreAlertcomment;
use App\Http\Controllers\Controller;

class AlertcommentsController extends Controller
{
    public function ajax(Request $request){
        $alertcomment = Alertcomment::find($request->id);
        $user = User::find($alertcomment->user_id);
            
        if($alertcomment->parent_id !== null){
            return response()->json([
                'responseData' => $alertcomment,
                'userData' => $user,
            ]);
        }else{
            $undercomment = Alertcomment::where('parent_id' , $alertcomment->id);
        
            // $underuser = User::find($undercomment->user_id);
            return response()->json([
                'responseData' => $alertcomment,
                'userData' => $user,
                'underData' => $undercomment,
                // 'underuserData' => $underuser,
            ]);
        }
    }
    
    public function store(StoreAlertcomment $request)
    {
        if($request->parent_id == null){
            $params = $request->validate([
                'alert_id' => 'required|exists:alerts,id',
                'comment' => 'required|max:140',
            ]);
        }
        else{
             $params = $request->validate([
                'alert_id' => 'required|exists:alerts,id',
                'parent_id' => 'required|exists:alertcomments,id',
                'comment' => 'required|max:140',
            ]);
        }
        
        //時間のセット
        date_default_timezone_set('Asia/Tokyo');
        $now = date("Y/m/d H:i");
        
        $request->user()->alertcomments()->create([
            'comment' => $request->comment,
            'alert_id' => $request->alert_id,
            'parent_id' => $request->parent_id,
            'time' => $now,
        ]);
        return back();
    }
    
    public function update(StoreAlertcomment $request, $id)
    {
        if($request->parent_id == null){
            $params = $request->validate([
                'alert_id' => 'required|exists:alerts,id',
                'comment' => 'required|max:140',
            ]);
        }
        else{
             $params = $request->validate([
                'alert_id' => 'required|exists:alerts,id',
                'parent_id' => 'required|exists:alertcomments,id',
                'comment' => 'required|max:140',
            ]);
        }
        
        //時間のセット
        date_default_timezone_set('Asia/Tokyo');
        $now = date("Y/m/d H:i");
        
        $alertcomment = Alertcomment::find($id);
            
        $alertcomment->comment = $request->comment;
        $alertcomment->alert_id = $request->alert_id;
        $alertcomment->parent_id = $request->parent_id;
        $alertcomment->time = $now;
        
        $alertcomment->save();
        
        return redirect('/alerts');
    }
    
    // deleteでalerts/idにアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        $alertcomment = Alertcomment::find($id);
        $alertcomment->delete();

        return redirect('/alerts');
    }
}

