<?php

namespace Modules\Users\Http\Controllers;

use App\User;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Facades\Config;
use Bouncer;

class UsersController extends Controller
{
    private $paginate = 0;

    function __construct()
    {
        $this->paginate = Config::get('app.pagesNumber');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if( request()->ajax() ) {

            $users = User::withTrashed()
            ->with('roles')
            ->paginate($this->paginate);
            return response()->json($users);

        }else{

            return view('users::index');
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        //listado de paises
        $countries = Country::all();
        return view('users::create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(UserCreateRequest $request)
    {
        //instanciamos la entidad
        $user = new User;
        //pasamos los datos
        $user->name = $request->name;
        $user->email = $request->email;
        //encriptamos la contraseña
        $user->password = bcrypt($request->password);
        //guardamos el usuario
        $user->save();
        //el usuario se inicia como deshabilitado
        $user->delete();
        //asignamos el rol
        Bouncer::assign($request->rol)->to($user);
        //devolvemos el usuario creado
        return response()->json($user);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('users::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {

        if( request()->ajax() ) {

            $user = User::with('roles')->find($id);
            //si usuario es vacío, entonces pasamos un vector con los datos
            //campos igualados a vacío, para el vue.
            if( empty($user) )
                $user = $this->_getDefaultResult();
            //devolvemos user y parseamos json
            return response()->json($user);

        }else{

            $user = User::findOrFail($id);
            return view('users::edit',compact('user'));
        }

    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UserEditRequest $request,$id)
    {
        //buscamos el usuario desde su id
        $user = User::find($id);
        //editamos los datos
        $user->name = $request->name;
        $user->email = $request->email;
        //si password es distinto de vacío, entonces actualizamos 
        if( $request->password )
            //encriptamos la contraseña
            $user->password = bcrypt($request->password);
        
        //actualizamos el usuario
        $user->save();

    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    /**
     * disabled or abled this register
     * @return Response
     */
    public function disabled($id)
    {
        if( request()->ajax() ) {
            //obtenemos el usuario
            $user = User::withTrashed()->find($id);
            //comprobamos si el usuario esta o no deshabilitado
            if( $user->deleted_at == null ){
                //disable usuario
                $user->delete();

            }else{
                //able usuario
                $user->restore();
            }
            //actualizamos usuario
            $user->save();
            return response()->json($user);
        }
    }

    /**
     * looking for data from param
     * @return Response
     */
    
    public function search($query)
    {
        $users = User::withTrashed()->with('roles')
        ->whereHas('roles', function ($q) use ($query) {
            $q->where('name', 'LIKE', '%'.$query.'%');
        })
        ->orWhere('name','LIKE','%' . $query . '%')
        ->paginate($this->paginate);
        return response()->json($users);
    }
    /**
     * get default object if empty
     * @return Response
     */
    private function _getDefaultResult() 
    {
        $obj =  [
            'user' => '',
            'password' => '',
            'email' => '',
            'deleted_at' => null,
            'card_number' => '',
            'card_number' => '',
            'country' => '',
            'city' => '',
            'address' => '',
            'address' => '',
            'telephone' => ''
        ];

        return (object)$obj;
    }
}
