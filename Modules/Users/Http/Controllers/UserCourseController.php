<?php

namespace Modules\Users\Http\Controllers;

use Auth;
use App\User;
use App\Models\Country;
use App\Models\UserCourse;
use App\Models\Course;
use App\Models\OrderLost;
use App\Models\Referral;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Dirape\Token\Token;
use Illuminate\Support\Facades\Config;
use Ssheduardo\Redsys\Facades\Redsys;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
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
        //donde recopilamos los datos del form
        $data = null;
        //montamos una traza con los datos enviados en el formulario
        $data = $request->name.'_'.$request->first_name.'_'.$request->last_name.'_'.
        $request->email.'_'.bcrypt($request->password).'_'.$request->country.'_'.$request->city.
        '_'.$request->address.'_'.$request->zip.'_'.$request->telephone.'_'.$request->prefix;
        //enciptamos la cadena obtenida
        $data = Crypt::encryptString($data);
        //iniciamos un carrito
        $order = new OrderLost;
        //setemos datos
        $order->course_id = $request->course_id;
        $order->name = $request->name.' '.$request->first_name.' '.$request->last_name;
        $order->email = $request->email;
        $order->data = $data;
        $order->time_line = 'Formulario de compra';
        $order->remember_token = (new Token())->Unique('order_losts', 'remember_token', 60);
        //guardamos
        $order->save();
        //actuamos según la respuesta trenga que ser asincrona o no
        if( request()->ajax() ) {
            //devolvemos los datos del order
            return response()->json($order);
        }else{
            return redirect('new-buy/resume-buy/'.$order->remember_token);
        }
    }

    /**
     * Muestra el resumen de la compra del curso.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function order($token)
    {
        //comprobamos un carrito con el token indicado
        $order = OrderLost::where('remember_token',$token)
        ->firstOrFail();
        //almacenamos el nuevo timeline
        $order->time_line = $order->time_line.'_Resumen de la compra';
        //guardamos
        $order->save();
        //recuperamos los datos del curso
        $course = Course::findOrFail($order->course_id);
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
        //comprobamos si existe un carrito
        $order = OrderLost::where('remember_token',$token)
        ->firstOrFail();
        //almacenamos el nuevo timeline
        $order->time_line = $order->time_line.'_Pasarela de Pago';
        //guardamos
        $order->save();
        //recuperamos los datos del curso
        $course = Course::findOrFail($order->course_id);

        try{

            $orderRedsys = $order->id.date('dmys');
            $orderRedsys = str_pad($orderRedsys,12,0,STR_PAD_LEFT);
            Redsys::setAmount($course->amount);
            Redsys::setOrder($orderRedsys);
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
        $order = OrderLost::where('remember_token',$token)
        ->firstOrFail();
        //almacenamos el nuevo timeline
        $order->time_line = $order->time_line.'_Error en el pago';
        $order->remember_token = null;
        //guardamos
        $order->save();

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
        //comprobamos si existe carrito mediante el token
        $order = OrderLost::where('remember_token',$token)
        ->firstOrFail();
        //recuperamos los datos del curso
        $course = Course::findOrFail($order->course_id);
        //comprobamos si hay o no usuario logado
        if( !Auth::user() ) {
            //creamos el usuario a través de los datos del carrito
            $data = explode('_',Crypt::decryptString($order->data));
            //instanciamos usuario para new
            $user = new User;
            //seteamos los datos
            $user->name = $data[0];
            $user->first_name = $data[1];
            $user->last_name = $data[2];
            $user->email = $data[3];
            $user->password = $data[4];
            $user->country = $data[5];
            $user->city = $data[6];
            $user->address = $data[7];
            $user->zip = $data[8];
            $user->telephone = $data[9];
            $user->prefix = $data[10];
            $user->save();
            //asignamos al usuario el rol
            Bouncer::assign('User')->to($user);
            //creamos la url referral
            Referral::setReferralOwn('new-account/sign-up-form/1',$user->id);
        }else{

            $user = User::findOrFail(Auth::user()->id);
        }
        //Bouncer::allow($user)->toOwn(User::class)->to('index');
        //habilitamos el curso al usuario
        $userCourse = new UserCourse;
        $userCourse->course_id = $order->course_id;
        $userCourse->user_id = $user->id;
        $userCourse->save();

        //enviamos el email
        Mail::to($user->email)->send(new SendEmail($user,$course));
        //Borramos de Order Lost la precompra y la convertimos en definitiva
        //esta parte falta por terminar el order end tabla
        $this->_setOrderEnd($token);
        
        return view('users::accept');
    }
    //metodo que borra el token y activa el usuario
    private function _setOrderEnd($token)
    {
        $preOrder = OrderLost::where('remember_token',$token)
        ->firstOrFail();
        $preOrder->forceDelete();
    }
}
