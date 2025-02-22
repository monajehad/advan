<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Gate;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    use CsvImportTrait;
    const PAGINATION_NO=20;

    public function index(Request $request)
    {
        // abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories=Category::select('id','name','status');
        if($request->search){
            $categories=$categories->where('name','like','%'.$request->search.'%')
            ;
        }
        $categories=$categories->orderBy('id','desc')->paginate(self::PAGINATION_NO);
        if ($request->ajax()) {
            $table_data=view('advan.admin.categories.table-data',compact('categories'))->render();
            return response()->json(['categories'=>$table_data]);

        }
        return view('advan.admin.categories.index',compact('categories'));


    }

    public function edit(Category $category)
    {
        // abort_if(Gate::denies('hits_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('advan.admin.categories.edit', compact('category'));
    }


    public function store(StoreCategoryRequest $request)
    {
        if($request->status == 'on'){
            $request->status='1';
      }
        $category=Category::create([
            'name'=>$request->name,
       'status'=>$request->status,
        ]);
        // $category = Category::create($request->all());

        return redirect()->route('admin.categories.index');
    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {

        if($request->status == 'on'){
            $request->status='1';
      }
    //   dd($request->status);
      $category->update([
        'name'=>$request->name,
       'status'=>$request->status,
]);
    //   dd($request->status);

    //   $category->update($request->all());


        return redirect()->route('admin.categories.index');
    }

    public function show(Category $category)
    {
        // abort_if(Gate::denies('category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('advan.admin.categories.show', compact('category'));
    }

    public function destroy(Request $request)
    {
        if(!$request->id)
        return response()->json(['status'=>false,'error'=>'لم يتم تحديد التصنيف']);
        $category=Category::where('id',$request->id)->first();
       if(!$category)
        return response()->json(['status'=>false,'error'=>'التصنيف غير موجود']);
       $delete=$category->delete();
       if(!$delete)
        return response()->json(['status'=>false,'error'=>'لم يتم حذف التصنيف']);
       return response()->json(['status'=>true,'success'=>'تم حذف التصنيف بنجاح']);


       return redirect()->route('admin.categories.index');


    }
    public function updateStatus($id)
    {
        $data = Category::findOrFail($id);
        if($data->status==1)
            $data->status=0;
        else if($data->status==0)
            $data->status=1;

        $data->update();
        return redirect()->route('admin.categories.index');
    }
    public function massDestroy(MassDestroyCategoryRequest $request)
    {
        Category::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
