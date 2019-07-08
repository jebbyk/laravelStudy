<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Blog\Admin\BaseAdminController;
use App\Http\Requests\BlogCategoryUpdateRequest;

class CategoryController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

       // dd(__METHOD__);

       $paginator = BlogCategory::paginate(5);

       return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        dd(__METHOD__);
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
        dd(__METHOD__);
    }

    /*/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   /* public function show($id)
    {
        //
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        //dd(__METHOD__);

        $item = BlogCategory::findOrFail($id);//dont user findOrFail in big projects (if you gettering information from different places)
        $categoryList = BlogCategory::all();

        return view('blog.admin.categories.edit', compact('item', 'categoryList' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        //
        //dd(__METHOD__, $request->all(),$id);


       // $validatedData = $this->validate($request, $rules);


        //dd($validatedData);



        $item = BlogCategory::find($id);//check for item existing
        if(empty($item)){//if no item then return to the previous page
            return back()
                ->withErrors(['msg' => "data id  = [{$id}] not found"])
                ->withInput();//will return to the previous page with saved input
        }

        $data = $request->all();//gettering data from our request (row)
        $result = $item
            ->fill($data)//will automaticaly find attributes to bee updated
            ->save();

        if($result){
            return redirect()->route('blog.admin.categories.edit', $item->id)->with(['success' => 'Successfuly saved']);
        }else{
            return back()
                ->withErrors(['msg' => "Saving error"])
                ->withInput();
        }


    }

   /* /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   /* public function destroy($id)
    {
        //
    }*/
}
