<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class FrontController extends BaseController
{
    public function home(Request $request){
        $this->data['traits'] = array(
            array(
                'title' => 'efficient',
                'srb_title' => 'efikasno',
                'text' => 'tekst',
                'icon' => "<i class='fa-solid fa-leaf'></i>"
            ),
            array(
                'title' => 'easy to revise',
                'srb_title' => 'lako za ponavljanje',
                'text' => 'tekst',
                'icon' => "<i class='fa-solid fa-reply'></i>"
            ),
            array(
                'title' => 'motivating',
                'srb_title' => 'motivaciono',
                'text' => 'tekst',
                'icon' => '<i class="fa-solid fa-person-walking"></i>'
            ),
            array(
                'title' => 'fun',
                'srb_title' => 'zabavno',
                'text' => 'tekst',
                'icon' => "<i class='fa-solid fa-puzzle-piece'></i>"
            )
        );

        $userTasks = null;
        if($request->session()->has('user')){
            $user_id = $request->session()->get('user')->id;
            $user = User::where('id', $user_id)->first();
            $userTasks = $user->userTasks;
        }
        $this->data['userTasks'] = $userTasks;

        return view('client.pages.home', $this->data/*, ['menu' => $this->data['menu']]*/);
    }

    public function about(){
        $team = Employee::where('department_id',1)->take(4)->get();

        $this->data['team'] = $team;

        return view('client.pages.about.index',$this->data);
    }

}
