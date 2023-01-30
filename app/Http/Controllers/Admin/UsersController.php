<?php

namespace App\Http\Controllers\Admin;
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Category;
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

    public function index(Request $request)
    {
        // abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = User::with([ 'categories'])->select(sprintf('*', (new User())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_show';
                $editGate = 'user_edit';
                $deleteGate = 'user_delete';
                $crudRoutePart = 'users';

            //     return view('partials.datatablesActions', compact(
            //     'viewGate',
            //     'editGate',
            //     'deleteGate',
            //     'crudRoutePart',
            //     'row'
            // ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('user_name', function ($row) {
                return $row->user_name ? $row->user_name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('roles', function ($row) {
                $labels = [];
                foreach ($row->roles as $role) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $role->title);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? User::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'roles']);

            return $table->make(true);
        }

        // $roles      = Role::get();
        $categories = Category::get();

        return view('advan.admin.users.index', compact('categories'));
    }

    public function create()
    {
        // abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::where('id' , '!=' , 2)->pluck('title', 'id');

        $categories = Category::pluck('name', 'id');

        return view('advan.admin.users.create', compact('roles', 'categories'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        // $user->roles()->sync($request->input('roles', []));
        // $user->user_type = $request->input('roles');
        $user->save();
        // $user->categories()->sync($request->input('categories', []));

        if ($request->file('image')) {
            $image = saveOriginalImage($request->file('image'),User::DIR_UPLOAD );
            $user->fill(['image' => $image])->save();
        }
        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        // abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($user->user_type == 2)
        {
            $roles = Role::where('id' , 2)->pluck('title', 'id');

        }else{
            $roles = Role::where('id' , '!=' , 2)->pluck('title', 'id');
        }

        $categories = Category::pluck('name', 'id');

        $user->load('roles', 'categories');

        return view('advan.admin.users.edit', compact('roles', 'categories', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
        $user->categories()->sync($request->input('categories', []));
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

    public function destroy(User $user)
    {
        // abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
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
}
