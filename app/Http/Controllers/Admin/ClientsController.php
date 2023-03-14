<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyClientRequest;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Models\ClientsSpecialty;
use App\Models\SystemConstant;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ClientsController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;
    const PAGINATION_NO=20;

    public function index(Request $request)
    {
        // abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data=[];
        $category_select=SystemConstant::select('id','name','value','type')->where([['type','category']])->orderBy('order')->get();
        $area_1_select=SystemConstant::select('id','name','value','type')->where([['type','area_1']])->orderBy('order')->get();

        $clients=Client::
        leftJoin('system_constants as category_constants', function($join) {
            $join->on('category_constants.value', '=', 'clients.category')->where('category_constants.type','category')->whereNull('category_constants.deleted_at');
        })->leftJoin('system_constants as area_1_constants', function($join) {
            $join->on('area_1_constants.value', '=', 'clients.area_1')->where('area_1_constants.type','area_1')->whereNull('area_1_constants.deleted_at');
        })
        ->select('category_constants.name as category_name','area_1_constants.name as area_1_name','clients.id','clients.specialty_id','clients.category','clients.name','clients.item','clients.area_1','clients.status')
        ->with(['specialty','clientHits']);
        if($request->select){
            $clients=$clients->where('name','like','%'.$request->select.'%')
            ;
        }
        $clients=$clients->orderBy('id','desc')->paginate(self::PAGINATION_NO);

        $data['clients']=$clients;
        $data['category_select']=$category_select;
        $data['area_1_select']=$area_1_select;
        if ($request->ajax()) {
            $table_data=view('advan.admin.clients.table-data',compact('data'))->render();
            return response()->json(['clients'=>$table_data]);

    }
    $clients_specialties = ClientsSpecialty::get();
    $specialties = ClientsSpecialty::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

    return view('advan.admin.clients.index', compact('clients_specialties','data','specialties'));




    }

    public function create()
    {
        // abort_if(Gate::denies('client_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data=[];
        $category_select=SystemConstant::select('id','name','value','type')->where([['type','category']])->orderBy('order')->get();
        $area_1_select=SystemConstant::select('id','name','value','type')->where([['type','area_1']])->orderBy('order')->get();
        $data['category_select']=$category_select;
        $data['area_1_select']=$area_1_select;
        $specialties = ClientsSpecialty::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('advan.admin.clients.create', compact('specialties','data'));
    }

    public function store(StoreClientRequest $request)
    {
        $client = Client::create($request->all());

        if ($request->input('image', false)) {
            $client->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $client->id]);
        }

        return redirect()->route('admin.clients.index');
    }

    public function edit(Client $client)
    {
        // abort_if(Gate::denies('client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $area_1_select=SystemConstant::select('id','name','value','type')->where([['status',1],['type','area_1']])->orderBy('order')->get();
        $data['area_1_select']=$area_1_select;
        $category_select=SystemConstant::select('id','name','value','type')->where([['status',1],['type','category']])->orderBy('order')->get();
        $datacat['category_select']=$category_select;
        $specialties = ClientsSpecialty::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');



        $client->load('specialty');

        return view('advan.admin.clients.edit', compact('specialties', 'client','data','datacat'));
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->all());

        if ($request->input('image', false)) {
            if (!$client->image || $request->input('image') !== $client->image->file_name) {
                if ($client->image) {
                    $client->image->delete();
                }
                $client->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($client->image) {
            $client->image->delete();
        }

        return redirect()->route('admin.clients.index');
    }

    public function show(Client $client)
    {
        // abort_if(Gate::denies('client_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client->load('specialty');

        return view('advan.admin.clients.show', compact('client'));
    }

    public function destroy(Request $request)
    {
        if(!$request->id)
        return response()->json(['status'=>false,'error'=>'لم يتم تحديد العميل']);
        $client=Client::where('id',$request->id)->first();
       if(!$client)
        return response()->json(['status'=>false,'error'=>'العميل غير موجود']);
       $delete=$client->delete();
       if(!$delete)
        return response()->json(['status'=>false,'error'=>'لم يتم حذف العميل']);
       return response()->json(['status'=>true,'success'=>'تم حذف العميل بنجاح']);


        return redirect()->route('admin.clients.index');

    }

    public function massDestroy(MassDestroyClientRequest $request)
    {
        Client::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        // abort_if(Gate::denies('client_create') && Gate::denies('client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Client();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
