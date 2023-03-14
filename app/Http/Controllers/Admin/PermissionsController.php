<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPermissionRequest;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionsController extends Controller
{
    const PAGINATION_NO=20;

    public function index(Request $request)
    {
        // abort_if(Gate::denies('permission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::all();
        // $permissions->orderBy('id','desc')->paginate(self::PAGINATION_NO);
        // if($request->search){
        //     $permissions=$permissions->where('name','like','%'.$request->search.'%');
        // }
        // $permissions=$permissions->orderBy('id','desc')->paginate(self::PAGINATION_NO);
        if ($request->ajax()) {
            $table_data=view('advan.admin.permissions.table-data',compact('permissions'))->render();
            return response()->json(['permissions'=>$table_data]);

        }
        return view('advan.admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        // abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('advan.admin.permissions.create');
    }

    public function store(StorePermissionRequest $request)
    {
        $permission = Permission::create($request->all());

        return redirect()->route('admin.permissions.index');
    }

    public function edit(Permission $permission)
    {
        // abort_if(Gate::denies('permission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('advan.admin.permissions.edit', compact('permission'));
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update($request->all());

        return redirect()->route('admin.permissions.index');
    }

    public function show(Permission $permission)
    {
        // abort_if(Gate::denies('permission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('advan.admin.permissions.show', compact('permission'));
    }

    public function destroy(Request $request)
    {
        if(!$request->id)
        return response()->json(['status'=>false,'error'=>'لم يتم تحديد الصلاحية']);
        $permission=Permission::where('id',$request->id)->first();
       if(!$permission)
        return response()->json(['status'=>false,'error'=>'الصلاحية غير موجود']);
       $delete=$permission->delete();
       if(!$delete)
        return response()->json(['status'=>false,'error'=>'لم يتم حذف الصلاحية']);
       return response()->json(['status'=>true,'success'=>'تم حذف الصلاحية بنجاح']);


       return redirect()->route('admin.permissions.index');


    }

    public function massDestroy(MassDestroyPermissionRequest $request)
    {
        Permission::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
