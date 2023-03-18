<?php

namespace App\Http\Controllers\Admin;
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Category;
use App\Models\Item;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
class UsersController extends Controller
{
    use MediaUploadingTrait;
    const PAGINATION_NO=20;

    public function index(Request $request)
    {
        // abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::with(['category','item','userHits','roles'])->select('id','name','email','mobile','home_address','jobId','status',
        'mobile',
        'home_address',
        'whatsapp_phone',
        'facebook',
        'instagram',
        'website',
        'category_id',
        'item_id');


            $users=$users->orderBy('id','desc')->paginate(self::PAGINATION_NO);
            if ($request->ajax()) {
                $table_data=view('advan.admin.users.table-data',compact('users'))->render();
                return response()->json(['users'=>$table_data]);

             }
             $categories = Category::pluck('name', 'id');
             $items = Item::pluck('name', 'id');
        $roles = Role::pluck('title', 'id');

        return view('advan.admin.users.index', compact('users','items', 'categories','roles'));
    }


    public function create()
    {
        // abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        // $categories = Category::pluck('name', 'id');
        // $items = Item::pluck('name', 'id');

        // return view('advan.admin.users.create', compact('items', 'categories'));
    }

    public function store(StoreUserRequest $request)
    {   if($request->status == 'on'){
        $request['status']='1';

         }
        $user = User::create($request->all());
        // $user->roles()->sync($request->input('roles', []));
        $user->user_type = $request->input('roles');
        $user->fcm_token = Str::random(60);
        $user->save();
        // $user->save();

        if ($request->file('image')) {
            $image = saveOriginalImage($request->file('image'),User::DIR_UPLOAD );
            $user->fill(['image' => $image])->save();
        }

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        // abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $categories = Category::pluck('name', 'id');
        $items = Item::pluck('name', 'id');

        $user->load('item', 'category');

        return view('advan.admin.users.edit', compact('items', 'categories','roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        if($request->status == 'on'){
            $request['status']='1';

      }
        $user->update($request->all());

        if ($request->file('image')) {
            $image = saveOriginalImage($request->file('image'),User::DIR_UPLOAD );
            $user->fill(['image' => $image])->save();
        }

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        // abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles', 'categories', 'userUserAlerts');

        return view('advan.admin.users.show', compact('user'));
    }

    public function destroy(Request $request)
    {
        // abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if(!$request->id)
        return response()->json(['status'=>false,'error'=>'لم يتم تحديد المندوب']);
    $user=User::where('id',$request->id)->first();
    if(!$user)
        return response()->json(['status'=>false,'error'=>'المندوب غير موجود']);
    $delete=$user->delete();
    if(!$delete)
        return response()->json(['status'=>false,'error'=>'لم يتم حذف المندوب']);
    return response()->json(['status'=>true,'success'=>'تم حذف المندوب بنجاح']);


    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        // abort_if(Gate::denies('user_create') && Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new User();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
    public function export_excel()
    {
        $users= User::with(['category','item','userHits','roles'])->select('id','name','email','mobile'
        ,'home_address','jobId',
        )
        ->orderBy('id','desc')->get();
        @ob_start();
        echo  chr(239) . chr(187) . chr(191);
        $table="
            <table border='1' class='table table-bordered text-center'>
            <thead>
            <tr>
            <th>#</th>
            <th>اسم الثلاثي</th>
                <th> البريد الالكتروني</th>
                <th> الجوال</th>
                <th> السكن</th>
                <th> الرقم الوظيفي</th>
                <th> الزيارات</th>
            </tr>
            </thead>
            <tbody style='text-align:center;'>
            ";
        if (count($users)>0) {
            foreach ($users as $key=>$user) {
                $i=$key+1;
                $table.="
                    <tr>
                        <td>". $i  ."</td>
                        <td >". $user->name  ."</td>
                        <td >". $user->email ."</td>
                        <td >". $user->mobile ."</td>
                        <td >". $user->home_address  ."</td>
                        <td >". $user->jobId ."</td>
                        <td >". $user->userHits()->count()  ."</td>

                    ";
                }
            }else{
                     $table.="
                     <tr>
                         <td style='text-align:center;font-weight:bold;' colspan=\"8\">لا يوجد مستخدمين</td>
                     </tr>
                     ";
            }
            $table.="
            </tbody>
            </table>
            ";
            echo $table;
            $filename="المندوب";
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=".$filename.".xls");
            header("Pragma: no-cache");
            header("Expires: 0");

    }
}
