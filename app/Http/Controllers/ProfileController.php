<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditPasswordRequest;
use App\Http\Requests\EditProfileRequest;
use App\Models\Language;
use App\Models\User;
use App\Models\UserAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProfileController extends BaseController
{
    public function index(Request $request){
        $user_id = $request->session()->get('user')->id;
        $user = User::where('id', $user_id)->first();
        $userTasks = $user->userTasks;

        $total = 0;
        foreach ($userTasks as $userTask){
            $total += $userTask->levels_finished;
        }

        $this->data['levelsFinished'] = $total;

        return view('client.pages.profile', $this->data);
    }

    public function editProfileIndex(){
        return view('client.pages.edit-profile.edit-profile');
    }

    public function editProfile(EditProfileRequest $request){
        $user_id = $request->session()->get('user')->id;
        $user = User::where('id', $user_id)->first();

        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $username = $request->input('username');
        $email = $request->input('email');
        $profile_picture = $request->file('profile_picture');

        try{
            $emailExists = DB::table('users')->where('email',$email)
                ->whereNot(function ($query) use ($user_id) {
                    $query->where('id', $user_id);
                })
                ->get()->count();;

            $usernameExists = DB::table('users')->where('username',$username)
                ->whereNot(function ($query) use ($user_id) {
                    $query->where('id', $user_id);
                })
                ->get()->count();


            if($emailExists > 0 && $usernameExists > 0){
                return back()->with('editProfileFail','Email and username have been already taken.');
            }
            if($emailExists > 0 || $usernameExists > 0){
                if($emailExists){
                    return back()->with('editProfileFail','Email has already been taken.');
                }
                if($usernameExists > 0){
                    return back()->with('editProfileFail','Username has already been taken.');
                }
            }

            if($profile_picture != null){

                $profile_picture_name = uniqid()."_".time().".".$profile_picture->extension();
                $profile_picture->storeAs("/public/img/profile_pictures", $profile_picture_name);

                $user->profile_picture = $profile_picture_name;
            }

            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->username = $username;
            $user->email = $email;
            $user->save();

            $action = new UserAction;
            $action->user_id = $user->id;
            $action->action = 'edit-profile';
            $action->save();

            $request->session()->put('user', $user);

            if($request->session()->get('user')->language_id == 2){
                return redirect()->route('profile')->with('editProfileSuccess',"Profil izmenjen uspešno.");;
            }
            else{
                return redirect()->route('profile')->with('editProfileSuccess',"Profile edited successfully.");;
            }


        }
        catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->with('editProfileFail', $ex);
        }
    }

    public function changePasswordIndex(){
        return view('client.pages.edit-profile.change-password');
    }

    public function changePassword(EditPasswordRequest $request){
        $user_id = $request->session()->get('user')->id;
        $user = User::where('id', $user_id)->first();

        $old_password = md5($request->input('old_password'));
        $new_password = md5($request->input('new_password'));


        try{
            $passwordCorrect = User::where('id',$user_id)->where('password',$old_password)->get();

            if($passwordCorrect->count() < 1){
                if($request->session()->get('user')->language_id == 2){
                    return back()->with("changePasswordFail","Stara lozinka nije tačna.");
                }
                else{
                    return back()->with("changePasswordFail","Old password isn't correct.");
                }
            }

            $user->password = $new_password;
            $user->save();

            $action = new UserAction;
            $action->user_id = $user->id;
            $action->action = 'change-password';
            $action->save();

            $request->session()->put('user', $user);

            if($request->session()->get('user')->language_id == 2){
                return redirect()->route('profile')->with('changePasswordSuccess',"Lozinka promenjena.");
            }
            else{
                return redirect()->route('profile')->with('changePasswordSuccess',"Password changed successfully.");
            }

        }
        catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->with('changePasswordFail', $ex);
        }
    }

    public function editGoalIndex(){
        return view('client.pages.edit-profile.edit-goal');
    }

    public function editGoal(Request $request){
        $user_id = $request->session()->get('user')->id;
        $value = $request->input('daily-goal');

        try{
            $user = User::where('id',$user_id)->first();

            if($value == null){
                return back()->with('editGoalFail', 'Please choose your daily goal.');
            }
            $user->daily_goal = $value;
            $user->save();

            $request->session()->put('user', $user);

            if($request->session()->get('user')->language_id == 2){
                return redirect()->route('profile')->with('editGoalSuccess',"Dnevni cilj promenjen uspešno.");
            }
            else{
                return redirect()->route('profile')->with('editGoalSuccess',"Daily goal changed successfully.");
            }


        }
        catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->with('editGoalFail', $ex);
        }
    }

    public function deleteProfile(Request $request){
        $user_id = $request->session()->get('user')->id;

        try{
            $user = User::where('id', $user_id)->first();
            $user->active = 0;
            $user->save();

            $request->session()->remove('user');
            return redirect()->route('home');
        }
        catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->with('editGoalFail', $ex);
        }
    }

    public function changeLanguage(Request $request, $language_id){
        $exists = true;

        if($language_id != 1 && $language_id != 2){
            //1 english
            //2 srpski
            $exists = false;
        }

        if($exists){
            $user_id = $request->session()->get('user')->id;
            $user = User::where('id', $user_id)->first();

            if($language_id != $user->language_id){
                $user->language_id = $language_id;
                $user->save();

                $request->session()->get('user')->language_id = $language_id;
            }
        }

        return back();
    }
}
