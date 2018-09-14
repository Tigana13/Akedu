<?php

namespace App\Http\Controllers\API\Colleges;

use App\Http\Resources\Colleges\CollegesResource;
use App\Models\College\College;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class CollegesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $colleges = College::with(['courses', 'facilities', 'intakes', 'locations.country'])->paginate(15);

        return CollegesResource::collection($colleges);
    }


    public function relation($relation = null)
    {
        $colleges = College::with($relation)->paginate(15);

        return CollegesResource::collection($colleges);
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
     * @return CollegesResource
     */
    public function store(Request $request)
    {
        $college = $request->isMethod('put') ? College::findOrFail($request->college_id) : new College();

        $college->college_name = $request->college_name;
        $college->college_email = $request->college_email;
        $college->password = ($request->has('password')) ? $request->password : Hash::make('secretpassword');

        if ($college->save()){
            return new CollegesResource($college);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return CollegesResource
     */
    public function show($id)
    {
        $college = College::findOrFail($id);

        return new CollegesResource($college);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return CollegesResource
     */
    public function destroy($id)
    {
        $college = College::findOrFail($id);

        if ($college->delete()){
            return new CollegesResource($college);
        }
    }
}
