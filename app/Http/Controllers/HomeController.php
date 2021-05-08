<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Session;
use DB;

class HomeController extends Controller
{
    public $locales = [];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->locales = [
            [
                'id'=>'01',
                'name'=>'Usaquén'
            ],
            [
                'id'=>'02',
                'name'=>'Chapinero'
            ]
        ];
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($tag = null)
    {
        if($tag == null){
            $users = User::where('parent_user_id',Auth::user()->id)->get();
        }else{
            $users = DB::table('users')->where([
                ['parent_user_id','=',Auth::user()->id],
                ['name','like','%'.$tag.'%']
            ])->orWhere([
                ['parent_user_id','=',Auth::user()->id],
                ['last_name','like','%'.$tag.'%']
            ])->orWhere([
                ['parent_user_id','=',Auth::user()->id],
                ['dni','like','%'.$tag.'%']
            ])->get();
        }   
        
        return view('home',['users' => $users, 'tag'=>$tag]);
    }

    public function friend_list($tag=null){
         if($tag == null){
            $users = User::where('parent_user_id',Auth::user()->id)->get();
        }else{
            $users = DB::table('users')->where([
                ['parent_user_id','=',Auth::user()->id],
                ['name','like','%'.$tag.'%']
            ])->orWhere([
                ['parent_user_id','=',Auth::user()->id],
                ['last_name','like','%'.$tag.'%']
            ])->orWhere([
                ['parent_user_id','=',Auth::user()->id],
                ['dni','like','%'.$tag.'%']
            ])->get();
        }   
        
        return view('friend-list',['users' => $users, 'tag'=>$tag]);
    }

    public function add(){
        $users = User::where('parent_user_id',Auth::user()->id)->get();
        return view('add', ['users' => $users, 'locales'=>$this->locales]);
    }

    public function edit_friend($id){
        $friend = User::findorfail($id);
        $users = User::where('parent_user_id',Auth::user()->id)->get();
        return view('edit', ['users' => $users, 'friend'=>$friend, 'locales'=>$this->locales]);
    }

    public function show_friend($id){
        $friend = User::findorfail($id);
        $users = User::where('parent_user_id',Auth::user()->id)->get();
        $referers = User::where('parent_user_id',$id)->get();
        return view('show', ['users' => $users, 'friend'=>$friend, 'locales'=>$this->locales,'referers'=>$referers]);
    }

    public function update_friend(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'dni' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'birth_date' => 'required',
            'sex'=>'required',
            'locale'=>'required'
        ]);

        $user = User::findorfail($id);
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->dni = $request->input('dni');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->email = $request->input('email');
        $user->birth_date = $request->input('birth_date');
        $user->sex = $request->input('sex');
        $user->locale = $request->input('locale');

        if($request->input('can_refer')){
            $user->can_refer = 1;
        }

         $users = User::where('dni',$request->input('dni'))->get();

        if($users->count() > 0){
            if($users[0]->id != $id){
                return redirect()->back()->withErrors(['exist_dni'=>'La persona que intentas agregar ya se encuentra en nuestra base de datos!!']);

            }
        }

        if($user->update()){
            Session::flash('success','Referido actualizado con Exito!!');
        }else{
            Session::flash('error','Error al actualizar el Referido!!');
        }

        return redirect()->route('home');
    }

    public function add_friend(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'last_name'=>'required',
            'birth_date'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'dni'=>'required',
            'sex'=>'required',
            'locale'=>'required'
        ]);

        $user = new User();

        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->birth_date = $request->input('birth_date');
        $user->address = $request->input('address');
        $user->dni = $request->input('dni');
        $user->password = bcrypt($request->input('dni'));
        $user->parent_user_id = Auth::user()->id;
        $user->sex = $request->input('sex');
        $user->locale = $request->input('locale');

        if($request->input('can_refer')){
            $user->can_refer = 1;
        }


        $users = User::where('dni',$request->input('dni'))->get();
        if($users->count() > 0){
            return redirect()->back()->withErrors(['exist_dni'=>'La persona que intentas agregar ya se encuentra en nuestra base de datos!!']);
        }

        if($user->save()){
            Session::flash('success','Referido Añadido con Exito!!');
        }else{
            Session::flash('error','Error al tratar de añadir el Referido!!');
        }

        return redirect()->route('home');
    }

    public function profile(){
        $users = User::where('parent_user_id',Auth::user()->id)->get();
        return view('profile', ['users' => $users, 'locales'=>$this->locales]);
    }

    public function update_profile(Request $request){
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'email|required',
            'phone' => 'required',
            'birth_date' => 'required',
            'address' => 'required',
            'dni' => 'required',
            'sex'=>'required',
            'locale'=>'required'
        ]);

        $user = User::findorfail(Auth::user()->id);
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->birth_date = $request->input('birth_date');
        $user->address = $request->input('address');
        $user->dni = $request->input('dni');
        $user->locale = $request->input('locale');
        $user->sex = $request->input('sex');

        if($user->update()){
            Session::flash('success','Perfil actualizado con Exito!!');
        }else{
            Session::flash('error','Error al actualizar el perfil!!');
        }

        return redirect()->route('home');
    }

    public function delete_friend($id){
        $user = User::findorfail($id);
        if($user->delete()){
            Session::flash('success','Referido eliminado con Exito!!');
        }else{
            Session::flash('error','Error al tratar de eliminar al referido!!');
        }
        return redirect()->route('home');
    }

    public function change_password(Request $request){
        $request->validate([
            'password' => 'required|same:password_confirmation',
            'password_confirmation' => 'required'
        ]);

        $user = User::findorfail(Auth::user()->id);
        $user->password = bcrypt($request->password);

        if($user->update()){
            Session::flash('success','Contraseña actualizada con Exito!!');
        }else{
            Session::flash('error','Error al cambiar la Contraseña!!');
        }  

        return redirect()->route('home');
    }

    public function view_password(){
        $users = User::where('parent_user_id',Auth::user()->id)->get();
        return view('change_password', ['users' => $users]);
    }

    public function administrator($cc=null, $locale=null){
        if($cc==null && $locale==null){
            $data = DB::select(DB::raw("SELECT * FROM users where is_admin is null")); 
        }else{
            if($cc!=null && $locale==null){
                $data = DB::select(DB::raw("SELECT * FROM users where is_admin is null and dni like '%".$cc."%'"));
            }

            if($cc==null && $locale!=null){
                $data = DB::select(DB::raw("SELECT * FROM users where is_admin is null and locale like '%".$locale."%'"));
            }

            if($cc!=null && $locale!=null){
                $data = DB::select(DB::raw("SELECT * FROM users where is_admin is null and (locale like '%".$locale."%' or dni like '%".$cc."%')"));
            }
            
        }

        $users = User::where('parent_user_id',Auth::user()->id)->get();
        
        return view('administrator',['users'=>$users,'locales'=>$this->locales, 'data'=>$data]);
    }

    public function error($tag = null)
    {
        if($tag == null){
            $users = User::where('parent_user_id',Auth::user()->id)->get();
        }else{
            $users = DB::table('users')->where([
                ['parent_user_id','=',Auth::user()->id],
                ['name','like','%'.$tag.'%']
            ])->orWhere([
                ['parent_user_id','=',Auth::user()->id],
                ['last_name','like','%'.$tag.'%']
            ])->orWhere([
                ['parent_user_id','=',Auth::user()->id],
                ['dni','like','%'.$tag.'%']
            ])->get();
        }   
        
        return view('error',['users' => $users, 'tag'=>$tag]);
    }
}
