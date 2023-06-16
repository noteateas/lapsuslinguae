<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Sentence;
use App\Models\Task;
use App\Models\User;
use App\Models\UserAction;
use App\Models\UserProgress;
use App\Models\WhyLearnALanguage;
use App\Models\Word;
use Illuminate\Support\Facades\Log;

class AdminController extends BaseController
{
    public function getlogin(){
        return view('admin.pages.login');
    }

    public function login(LoginRequest $request){
        try{
            $username = $request->input('username');
            $password = md5($request->input('password'));
            $user = User::where([
                ['password',$password],
                ['email',$username]
            ])->orWhere([
                ['password',$password],
                ['username',$username]
            ])->first();

            if($user){
                if($user->role_id == 1){ //admin
                    $request->session()->put('user',$user);

                    $action = new UserAction;
                    $action->user_id = $user->id;
                    $action->action = 'login';
                    $action->save();

                    return redirect()->route('admin-home')->with('loginSuccess', 'Welcome back.');
                }
                else{
                    return back()->with('loginFail', 'Admin with these credentials does not exist.');
                }
            }

            return back()->with('loginFail', 'Username or password incorrect.');
        }
        catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->with('loginFail', $ex);
        }
        return view('admin.pages.home');
    }

    public function home(){
        $date_today = date('Y-m-d');
        $words = count(Word::all());
        $sentences = count(Sentence::all());
        $tasks = count(Task::all());
        $usersLoggedIn = count(UserAction::where('created_at','like','%'.$date_today.'%')->where('action','login')->get());
        $userProgress = count(UserProgress::where('date',$date_today)->get());
        $userWhyLearnLanguage = User::select('why_learn_a_language_id')->where('active',1)->get();
        $whyLearnLanguage = WhyLearnALanguage::all();

        foreach($whyLearnLanguage as $el){
            $el->totalUsers = 0;
        }

        foreach($userWhyLearnLanguage as $userWhy){
            foreach ($whyLearnLanguage as $item) {
                if($userWhy->why_learn_a_language_id == $item->id){
                    $item->totalUsers = $item->totalUsers + 1;
                }
            }
        }

        $this->data['words'] = $words;
        $this->data['sentences'] = $sentences;
        $this->data['tasks'] = $tasks;
        $this->data['usersLoggedIn'] = $usersLoggedIn;
        $this->data['userProgress'] = $userProgress;
        $this->data['whyLearnLanguage'] = $whyLearnLanguage;

        return view('admin.pages.home', $this->data);
    }
}
