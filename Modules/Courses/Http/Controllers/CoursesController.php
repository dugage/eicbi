<?php

namespace Modules\Courses\Http\Controllers;

use Auth;
use App\Models\UserCourse;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;

class CoursesController extends Controller
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

            $courses = Course::paginate($this->paginate);
            return response()->json($courses);

        }else{

            return view('courses::index');
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('courses::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //instanciamos la entidad
        $course = new Course;
        //pasamos los datos
        $course->name = $request->name;
        $course->amount = $request->amount;
        //guardamos la categoría
        $course->save();
        //devolvemos el link referral creado
        return response()->json($course);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);

        if( request()->ajax() ) {

            //si curso es vacío, entonces pasamos un vector con los datos
            //campos igualados a vacío, para el vue.
            if( empty($course) )
                $course = $this->_getDefaultResult();
            //devolvemos course y parseamos json
            return response()->json($course);

        }else{

            return view('courses::edit',compact('course'));
        }

    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id,Request $request)
    {
        //buscamos el curso desde su id
        $course = Course::find($id);
        //seteamos los datos
        $course->name = $request->name;
        //actualizamos el curso
        $course->save();
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    /**
     * show coourse by id
     * @return Response
     */
    public function show($id)
    {
        //lo primero que hacemos es comprobar si el id del curso
        //lo tiene o no asignado el usuario, de esta forma, evitamos 
        //que se pueda acceder de forma manual cambiando el id en la url.
        $isCourse = UserCourse::with('course')
        ->Where('user_id',Auth::user()->id)
        ->Where('course_id',$id)
        ->firstOrFail();
        //obtenemos el curso junto con la colección de capítulos del curso mediante su id
        $course = Course::with('chapters')
        ->findOrFail($id);
        //Pasamos los datos a la vista
        return view('courses::show_course',compact('course'));
        
    }

    /**
     * looking for data from param
     * @return Response
     */
    public function search($query)
    {
        $courses = Course::Where('name','LIKE','%' . $query . '%')
        ->paginate($this->paginate);
        return response()->json($courses);
    }

    /**
     * getting courses by user
     * @return Response
     */
    public function getCoursesByUser()
    {
        $courses = UserCourse::with('course')
        ->Where('user_id',Auth::user()->id)
        ->get();
        //dump($courses);
        return view('courses::my_courses',compact('courses'));
    }

    /**
     * get default object if empty
     * @return Response
     */
    private function _getDefaultResult() 
    {
        $obj =  [
            'name' => '',
            'amount' => '',
        ];

        return (object)$obj;
    }
}
