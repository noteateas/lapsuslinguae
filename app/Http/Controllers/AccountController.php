<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\UserAction;
use App\Models\UserProgress;
use App\Models\WhyLearnALanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Psy\Util\Json;

class  AccountController extends BaseController
{

    public function getregister(){
        $this->data['why_learn_a_language'] = WhyLearnALanguage::all();
        $this->data['svg_container_animation'] = [
            '<div class="icon">
                                        <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,582.0697525312426C382.5290701553225,586.8405444964366,449.9789794690241,525.3245884688669,502.5850820975895,461.55621195738473C556.606425686781,396.0723002908107,615.8543463187945,314.28637112970534,586.6730223649479,234.56875336149918C558.9533121215079,158.8439757836574,454.9685369536778,164.00468322053177,381.49747125262974,130.76875717737553C312.15926192815925,99.40240125094834,248.97055460311594,18.661163978235184,179.8680185752513,50.54337015887873C110.5421016452524,82.52863877960104,119.82277516462835,180.83849132639028,109.12597500060166,256.43424936330496C100.08760227029461,320.3096726198365,92.17705696193138,384.0621239912766,124.79988738764834,439.7174275375508C164.83382741302287,508.01625554203684,220.96474134820875,577.5009287672846,300,582.0697525312426"></path>
                                        </svg>
                                        <i class="bx bx-file"></i>
                                    </div>',
            '<div class="icon">
                                        <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,541.5067337569781C382.14930387511276,545.0595476570109,479.8736841581634,548.3450877840088,526.4010558755058,480.5488172755941C571.5218469581645,414.80211281144784,517.5187510058486,332.0715597781072,496.52539010469104,255.14436215662573C477.37192572678356,184.95920475031193,473.57363656557914,105.61284051026155,413.0603344069578,65.22779650032875C343.27470386102294,18.654635553484475,251.2091493199835,5.337323636656869,175.0934190732945,40.62881213300186C97.87086631185822,76.43348514350839,51.98124368387456,156.15599469081315,36.44837278890362,239.84606092416172C21.716077023791087,319.22268207091537,43.775223500013084,401.1760424656574,96.891909868211,461.97329694683043C147.22146801428983,519.5804099606455,223.5754009179313,538.201503339737,300,541.5067337569781"></path>
                                        </svg>
                                        <i class="bx bx-tachometer"></i>
                                    </div>',
            '<div class="icon">
                                        <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,503.46388370962813C374.79870501325706,506.71871716319447,464.8034551963731,527.1746412648533,510.4981551193396,467.86667711651364C555.9287308511215,408.9015244558933,512.6030010748507,327.5744911775523,490.211057578863,256.5855673507754C471.097692560561,195.9906835881958,447.69079081568157,138.11976852964426,395.19560036434837,102.3242989838813C329.3053358748298,57.3949838291264,248.02791733380457,8.279543830951368,175.87071277845988,42.242879143198664C103.41431057327972,76.34704239035025,93.79494320519305,170.9812938413882,81.28167332365135,250.07896920659033C70.17666984294237,320.27484674793965,64.84698225790005,396.69656628748305,111.28512138212992,450.4950937839243C156.20124167950087,502.5303643271138,231.32542653798444,500.4755392045468,300,503.46388370962813"></path>
                                        </svg>
                                        <i class="bx bx-layer"></i>
                                    </div>',
            '<div class="icon">
                                        <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,532.3542879108572C369.38199826031484,532.3153073249985,429.10787420159085,491.63046689027357,474.5244479745417,439.17860296908856C522.8885846962883,383.3225815378663,569.1668002868075,314.3205725914397,550.7432151929288,242.7694973846089C532.6665558377875,172.5657663291529,456.2379748765914,142.6223662098291,390.3689995646985,112.34683881706744C326.66090330228417,83.06452184765237,258.84405631176094,53.51806209861945,193.32584062364296,78.48882559362697C121.61183558270385,105.82097193414197,62.805066853699245,167.19869350419734,48.57481801355237,242.6138429142374C34.843463184063346,315.3850353017275,76.69343916112496,383.4422959591041,125.22947124332185,439.3748458443577C170.7312796277747,491.8107796887764,230.57421082200815,532.3932930995766,300,532.3542879108572"></path>
                                        </svg>
                                        <i class="bx bx-slideshow"></i>
                                    </div>',
            '<div class="icon">
                    <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                        <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,566.797414625762C385.7384707136149,576.1784315230908,478.7894351017131,552.8928747891023,531.9192734346935,484.94944893311C584.6109503024035,417.5663521118492,582.489472248146,322.67544863468447,553.9536738515405,242.03673114598146C529.1557734026468,171.96086150256528,465.24506316201064,127.66468636344209,395.9583748389544,100.7403814666027C334.2173773831606,76.7482773500951,269.4350130405921,84.62216499799875,207.1952322260088,107.2889140133804C132.92018162631612,134.33871894543012,41.79353780512637,160.00259165414826,22.644507872594943,236.69541883565114C3.319112789854554,314.0945973066697,72.72355303640163,379.243833228382,124.04198916343866,440.3218312028393C172.9286146004772,498.5055451809895,224.45579914871206,558.5317968840102,300,566.797414625762"></path>
                    </svg>
                    <i class="bx bx-arch"></i>
                </div>'
        ];

        return view('client.pages.register', $this->data);
    }

    public function getlogin(){
        return view('client.pages.login', $this->data);
    }

    public function login(LoginRequest $request){
        try{
            $username = $request->input('username');
            $password = md5($request->input('password'));
            /*u zavisnosti koja je greska, neka se vrati uvek nazad info
            ako za password nije nista ispostovano neka onda pise da je required, ne treba da se budzi i sa ostalim
            greskama. u sledecem requestu neka pise sledeca validaciona greska ako je ima. i tako sve po redu.*/

            $user = User::where([
                ['password',$password],
                ['email',$username]
            ])->orWhere([
                ['password',$password],
                ['username',$username]
            ])->where('active',1)->first();

            if($user){
                if($user->role_id==1){ //admin
                    return redirect()->route('admin-login');
                }
                else{
                    $request->session()->put('user',$user);

                    $action = new UserAction;
                    $action->user_id = $user->id;
                    $action->action = 'login';
                    $action->save();
                    //streak
                    if($user->streak != 0){
                        $date_today = date('Y-m-d');
                        $date_yesterday =  date('Y-m-d',strtotime('yesterday'));
                        $userProgress = UserProgress::where('user_id',$user->id)->get();
                        $userProgressYesterday =$userProgress->where('date',$date_yesterday)->first();
                        $userProgressToday = $userProgress->where('date',$date_today)->first();

                        //dd($userProgressYesterday);
                        if(!$userProgressYesterday){
                            if($userProgressToday && $user->streak == 1){
                                //danas je prva vezba koja je uradio i dobio streak od 1 dana
                                $request->session()->get('user')->streak = $user->streak;
                            }
                            else{
                                //resetovanje streaka jer nije uradjena vezba juce
                                if($user->streak != 0){
                                    $user->streak = 0;
                                    $user->save();
                                }
                                $request->session()->get('user')->streak = 0;
                            }
                        }
                        else{
                            //ima streak duzi od 1,
                            $request->session()->get('user')->streak = $user->streak;
                        }
                    }
                    else{
                        //streak mu je nula, stoji ovde da bi se apdejtovao session, nzm da li je neophodno
                        $request->session()->get('user')->streak = 0;
                    }
                    //streak

                    return redirect()->route('home')->with('loginSuccess', 'Welcome back.');
                }
            }

            return back()->with('loginFail', 'Username or password incorrect.');
        }
        catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->with('loginFail', $ex);
        }
    }

    public function logout(Request $request){

        try{
            if(session()->has('user')){

                $action = new UserAction;

                $action->user_id = session()->get('user')->id;
                $action->action = 'logout';

                $action->save();

                $request->session()->remove('user');
            }
        }
        catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->with('logoutFail', $ex);
        }

        return redirect()->route('home');
    }

    public function register(RegisterRequest $request){
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $username = $request->input('username');
        $email = $request->input('email');
        $password = md5($request->input('password'));
        $birth_date = $request->input('birth_date');
        $profile_picture = $request->file('profile_picture');
        $why_learn_a_language_id = $request->input('why-learn-a-language');

        try{
            $user = new User;

            $emailExists = User::where('email',$email)->get()->count();
            $usernameExists = User::where('username',$username)->get()->count();

            if($emailExists && $usernameExists){
                return back()->with('regFail','Email and username have been already taken.');
            }
            if($emailExists || $usernameExists){
                if($emailExists){
                    return back()->with('regFail','Email has already been taken.');
                }
                if($usernameExists){
                    return back()->with('regFail','Username has already been taken.');
                }
            }

            if($profile_picture != null){

                $profile_picture_name = uniqid()."_".time().".".$profile_picture->extension();
                $profile_picture->storeAs("/public/img/profile_pictures", $profile_picture_name);

                $user->profile_picture = $profile_picture_name;
            }
            else{
                $user->profile_picture = null;
            }

            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->username = $username;
            $user->email = $email;
            $user->password = $password;
            $user->birth_date = $birth_date;
            $user->why_learn_a_language_id = $why_learn_a_language_id;
            $user->role_id = 2;
            $user->save();

            $action = new UserAction;
            $action->user_id = $user->id;
            $action->action = 'register';
            $action->save();

            $user->daily_goal = 1;
            $user->language_id = 1;
            $request->session()->put('user',$user);
            return redirect()->route('home')->with('loginSuccess', 'Welcome.');
        }
        catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->with('regFail', $ex);
        }
    }

    public function checkExistsEmailOrUsernameDuringRegister(Request $request){

        $email = $request->email;
        $username = $request->username;

        $emailExists = User::where('email',$email)->get()->count();
        $usernameExists = User::where('username',$username)->get()->count();


        if($emailExists && $usernameExists){
            return Json::encode("UsernameAndEmailExist");
        }
        else if($emailExists || $usernameExists){
            if($emailExists){
                return Json::encode('EmailExists');
            }
            if($usernameExists){
                return Json::encode('UsernameExists');
            }
        }
        else{
            return Json::encode('NotExists');
        }
    }

}
