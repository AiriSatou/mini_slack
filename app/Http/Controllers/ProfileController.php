<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ProfileController extends Controller
{
     public function edit(){
        $user = auth()->user(); //認証中のユーザーを取得
        return view('profile.edit', compact('user'));
        }
        
        public function update(Request $request)
        {
             $validated = $request->validate([
            'display_name' => 'nullable|string|max:30',
            ]);
            
            $user = auth()->user(); 
            $user->update($validated); 
            
            return redirect()->route('profile.edit')->with('success', 'プロフィールを更新しました');
            }
}
