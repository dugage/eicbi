<?php

namespace Modules\Users\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class UsersController extends Controller
{
    private $paginate = 10;

    function __construct()
    {
        $this->paginate = 10;
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
    public function store(Request $request)
    {
        //validamos los datos
        $data = $request->validate([

            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        //creamos el usuario
        $user = User::create([

            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),//encriptamos la contraseña

        ]);
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
            
            if( empty($user) )
                $user = $this->_getDefaultResult();

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
    public function update(Request $request)
    {
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

}
