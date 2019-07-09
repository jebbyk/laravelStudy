<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Http\Controllers\Blog\Admin\BaseAdminController;
use App\Repositories\BlogCategoryRepository;

class CategoryController extends BaseAdminController
{
    /**
     * @var blogCategoryReposioty
     */
    private $blogCategoryRepository;

    public function __construct()
    {
        parent::__construct();
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       //$paginator = BlogCategory::paginate(5);
        $paginator = $this->blogCategoryRepository->getAllWithPaginate(5);
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
        //dd(__METHOD__);

        $item = new BlogCategory();
        //$categoryList = BlogCategory::all();
        $categoryList = $this->blogCategoryRepository->getForCombobox();

        return view('blog.admin.categories.create', compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        //
        //dd(__METHOD__);
        $data = $request->input();
        if(empty($data['slug'])){
            $data['slug'] = str_slug($data['title']);
        }

        $item = new BlogCategory($data);
        $item->save();

        if($item){
            return redirect()->route('blog.admin.categories.create', [$item->id])
            ->with(['success' => 'Successfuly saved']);
        } else {
            return back()->withErrors(['msg' => 'Saving error'])
            ->withInput();
        }
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
        /*$item = BlogCategory::findOrFail($id);//dont user findOrFail in big projects (if you gettering information from different places)
        $categoryList = BlogCategory::all();*/

        $item = $this->blogCategoryRepository->getEdit($id);
        if(empty($item)){
            abort(404);
        }

        $categoryList = $this->blogCategoryRepository->getForComboBox();

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
        //$item = BlogCategory::find($id);//check for item existing

        $item = $this->blogCategoryRepository->getEdit($id);

        if(empty($item)){//if no item then return to the previous page
            return back()
                ->withErrors(['msg' => "data id  = [{$id}] not found"])
                ->withInput();//will return to the previous page with saved input
        }

        $data = $request->all();//gettering data from our request (row)

        if(empty($data['slug'])){
            $data['slug'] = str_slug($data['title']);
        }

        $result = $item->update($data);
        /*$result = $item
            ->fill($data)//will automaticaly find attributes to bee updated
            ->save();*/

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
