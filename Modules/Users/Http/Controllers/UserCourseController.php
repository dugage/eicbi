<?php

namespace Modules\Users\Http\Controllers;

use App\User;
use App\Models\Country;
use App\Models\UserCourse;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Dirape\Token\Token;
use Illuminate\Support\Facades\Config;
use Ssheduardo\Redsys\Facades\Redsys;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;
use Bouncer;

class UserCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     * Formulario de registro mediante la compra de un curso
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //obtenemos el listado de paises
        $countries = Country::all();
        $courseId = $id;
        return view('users::buycourse',compact('countries','courseId'));
    }

    /**
     * Muestra el resumen de la compra del curso.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'country' => '',
            'city' => '',
            'address' => '',
            'zip' => '',
            'telephone' => '',
            'prefix' => '',
            'course_id' => 'required'
        ]);

        $user = User::create([

            'name' => $data['name'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'country' => $data['country'],
            'city' => $data['city'],
            'address' => $data['address'],
            'zip' => $data['zip'],
            'telephone' => $data['telephone'],
            'prefix' => $data['prefix'],
            'remember_token' => (new Token())->Unique('users', 'remember_token', 60).$data['course_id'],

        ]);

        Bouncer::assign('User')->to($user);

        return response()->json($user);
    }

    /**
     * Muestra el resumen de la compra del curso.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function order($token)
    {
        //comprobamos si existe el usuario mediante el token
        $user = User::where('remember_token',$token)->firstOrFail();
        //recuperamos el id del curso
        $idCourse = substr($token, -1);
        //recuperamos los datos del curso
        $course = Course::findOrFail($idCourse);
        return view('users::order_summary',compact('course','token'));
    }

     /**
     * Muestra el resumen de la compra del curso.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function setRedsys($token,$display = false,$des = false)
    {
        //comprobamos si existe el usuario mediante el token
        $user = User::where('remember_token',$token)->firstOrFail();
        //recuperamos el id del curso
        $idCourse = substr($token, -1);
        //recuperamos los datos del curso
        $course = Course::findOrFail($idCourse);

        try{

            $order = $user->id.date('dmys');
            $order = str_pad($order,12,0,STR_PAD_LEFT);
            Redsys::setAmount($course->amount);
            Redsys::setOrder($order);
            Redsys::setMerchantcode('061941670');
            Redsys::setCurrency('978');
            Redsys::setTransactiontype('0');
            Redsys::setTerminal('1');
            Redsys::setMethod('T');
            Redsys::setNotification(route('new-account.setredsys',$token));
            Redsys::setUrlOk(route('new-account.acceptedbuy',$token));
            Redsys::setUrlKo(route('new-account.cancelledbuy',$token));
            Redsys::setVersion('HMAC_SHA256_V1');
            Redsys::setTradeName('EICBI | Escuela Internacional de Criptomonedas Blockchain e Inversiones');
            Redsys::setTitular('EICBI');
            Redsys::setProductDescription($course->name);
            Redsys::setEnviroment('test');
            $signature = Redsys::generateMerchantSignature('sq7HjrUOBfKmC576ILgskD5srU870gJ7');
            Redsys::setMerchantSignature($signature);

            if($display==false){
            
                Redsys::setAttributesSubmit('btn_submit', 'btn_id', 'Enviar', 'display:none');
                return Redsys::executeRedirection();
            
            }else{
            
                return Redsys::createForm();
            
            }
        
        }
        catch(Exception $e){
        
            echo $e->getMessage();
        
        }
        //return view('users::order_summary',compact('course'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($token)
    {
        //comprobamos si existe el usuario mediante el token
        $user = User::where('remember_token',$token)->firstOrFail();
        //borramos el token
        $this->_destroyToken($token);
        return view('users::cancel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function accept($token)
    {
        //recuperamos el id del curso
        $idCourse = substr($token, -1);
        //comprobamos si existe el usuario mediante el token
        $user = User::where('remember_token',$token)->firstOrFail();
        //habilitamos el curso al usuario
        $userCourse = new UserCourse;
        $userCourse->course_id = $idCourse;
        $userCourse->user_id = $user->id;
        $userCourse->save();
        //enviamos el email
        Mail::to($user->email)->send(new SendEmail());
        //borramos el token, por seguridad, con esto nos aseguramos que no se pueda accceder a esta página
        //y que no se pueda recargar.
        $this->_destroyToken($token);
        return view('users::accept');
    }
    //metodo que borra el token
    private function _destroyToken($token)
    {
        $user = User::where('remember_token',$token)->firstOrFail();
        $user->remember_token = '';
        $user->save();
    }
}
