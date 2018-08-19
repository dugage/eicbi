<?php

namespace Modules\VideoCategories\Http\Controllers;

use App\Models\VideoCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class VideoCategoriesController extends Controller
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

            $categories = VideoCategory::paginate($this->paginate);
            return response()->json($categories);

        }else{

            return view('videocategories::index');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('videocategories::create');
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
        return view('videocategories::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('videocategories::edit');
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
        $categories = VideoCategory::Where('name','LIKE','%' . $query . '%')
        ->paginate($this->paginate);
        return response()->json($categories);
    }
}
