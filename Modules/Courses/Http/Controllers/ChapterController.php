<?php

namespace Modules\Courses\Http\Controllers;

use App\Models\CourseChapter;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if( request()->ajax() ) {
            
            $chapters = Course::find($id)->chapters;
            return response()->json($chapters);
            
        }else{

            abort(404);
        }; 

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if( request()->ajax() ) {
            //consultamos mediante el id, si existe o no el item
            $chapter = CourseChapter::find($id);
            //si no existe, entocnes llamamos al método privado _getDefaultResult que devolvera un objeto con los datos empty
            if( empty($chapter) )
                $chapter = $this->_getDefaultResult();

            return response()->json($chapter);

        }else{

            abort(404);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chapter $chapter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chapter $chapter)
    {
        //
    }
    /**
     * get default object if empty
     * @return Response
     */
    private function _getDefaultResult() 
    {
        $obj =  [
            
            'course_id' => 0,
            'name' => '',
            'video' => '',
            'text ' => '',
            'attached ' => '',
        ];
        return (object)$obj;
    }

}
