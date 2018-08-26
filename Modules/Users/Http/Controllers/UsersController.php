<?php

namespace Modules\Users\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Facades\Config;

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

            $users = User::with('roles')->paginate($this->paginate);
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
        return view('users::create');
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
        $user = User::find($id);

        if( request()->ajax() ) {

            //si usuario es vacío, entonces pasamos un vector con los datos
            //campos igualados a vacío, para el vue.
            if( empty($user) )
                $user = $this->_getDefaultResult();
            //devolvemos user y parseamos json
            return response()->json($user);

        }else{

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
     * looking for data from param
     * @return Response
     */
    public function search($query)
    {
        $users = User::with('roles')
        ->Where('name','LIKE','%' . $query . '%')
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
        ];

        return (object)$obj;
    }
}
