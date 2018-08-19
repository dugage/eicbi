<?php

namespace Modules\Videos\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class VideosController extends Controller
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

            $videos = Video::paginate($this->paginate);
            return response()->json($videos);

        }else{

            return view('videos::index');
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('videos::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('videos::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('videos::edit');
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
        $videos = Video::Where('name','LIKE','%' . $query . '%')
        ->orWhere('category_name','LIKE','%' . $query . '%')
        ->paginate($this->paginate);
        return response()->json($videos);
    }
}
