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
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdfuse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        if($request->clientSelect){
                    $clients=$clients->where('clients.name',$request->clientSelect)
                    ;
                }
                if($request->clientSpecialty){
                    $clients=$clients->where('clients.specialty_id',$request->clientSpecialty)
                    ;
                }
                if($request->area){
                    $clients=$clients->where('clients.area_1',$request->area)
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


        // abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $data=[];
    //     $category_select=SystemConstant::select('id','name','value','type')->where([['type','category']])->orderBy('order')->get();
    //     $area_1_select=SystemConstant::select('id','name','value','type')->where([['type','area_1']])->orderBy('order')->get();

    //     $clients=Client::
    //     leftJoin('system_constants as category_constants', function($join) {
    //         $join->on('category_constants.value', '=', 'clients.category')->where('category_constants.type','category');
    //     })->leftJoin('system_constants as area_1_constants', function($join) {
    //         $join->on('area_1_constants.value', '=', 'clients.area_1')->where('area_1_constants.type','area_1');
    //     })
    //     ->select('category_constants.name as category_name','area_1_constants.name as area_1_name','clients.id','clients.specialty_id','clients.category','clients.name','clients.item','clients.area_1','clients.status')
    //     ->with(['specialty','clientHits']);
    //     if($request->clientSelect){
    //         $clients=$clients->where('clients.name',$request->clientSelect)
    //         ;
    //     }
    //     if($request->clientSpecialty){
    //         $clients=$clients->where('clients.specialty_id',$request->clientSpecialty)
    //         ;
    //     }
    //     if($request->area){
    //         $clients=$clients->where('clients.area_1',$request->area)
    //         ;
    //     }

    //     $data['clients']=$clients;
    //     $data['category_select']=$category_select;
    //     $data['area_1_select']=$area_1_select;
    //     if ($request->ajax()) {
    //         $table_data=view('advan.admin.clients.table-data',compact('data'))->render();
    //         return response()->json(['clients'=>$table_data]);

    // }
    // // dd($data['clients']);
    // $clients_specialties = ClientsSpecialty::get();
    // $specialties = ClientsSpecialty::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

    // return view('advan.admin.clients.index', compact('clients_specialties','data','specialties','clients'));




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
        if($request->status == 'on' ){
            $request['status']='1';
      }
      else{
        $request['status']='0';
      }
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
        if($request->status == 'on' ){
            $request['status']='1';
      }else{
        $request['status']='0';
      }
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

    public function massDestroy(Request $request)
    {
        $ids = $request->ids;
        DB::table("clients")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"تم حذف العميل؟ ."]);
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


    public function export_excel()
    {
        $clients=Client::
        leftJoin('system_constants as category_constants', function($join) {
            $join->on('category_constants.value', '=', 'clients.category')->where('category_constants.type','category')->whereNull('category_constants.deleted_at');
        })->leftJoin('system_constants as area_1_constants', function($join) {
            $join->on('area_1_constants.value', '=', 'clients.area_1')->where('area_1_constants.type','area_1')->whereNull('area_1_constants.deleted_at');
        })
        ->select('category_constants.name as category_name','area_1_constants.name as area_1_name','clients.id','clients.specialty_id','clients.category','clients.name','clients.item','clients.area_1','clients.status')
        ->with(['specialty','clientHits'])
        ->orderBy('id','desc')->get();
        $data['clients']=$clients;
        @ob_start();
        echo  chr(239) . chr(187) . chr(191);
        $table="
            <table border='1' class='table table-bordered text-center'>
            <thead>
            <tr>
            <th>#</th>
            <th>اسم العميل</th>
            <th> النوع</th>
            <th> التخصص</th>
            <th> التصنيف</th>
            <th> المنطقة</th>
            <th> الزيارات</th>
            <th> العينات</th>


            </tr>
            </thead>
            <tbody style='text-align:center;'>
            ";
        if (count($clients)>0) {
            foreach ($clients as $key=>$client) {
                $i=$key+1;
                $table.="
                    <tr>
                        <td>". $i  ."</td>
                        <td >". $client->name  ."</td>
                        <td >". $client->category_name ."</td>
                        <td >". $client->specialty->name  ." </td>
                        <td >". $client->item ."</td>
                        <td >". $client->area_1_name ."</td>
                        <td >". $client->clientHits()->count() ."</td>
                        <td >". $client->clientHits()->get()->sum('number_samples') ."</td>

                    ";
                }
            }else{
                     $table.="
                     <tr>
                         <td style='text-align:center;font-weight:bold;' colspan=\"8\">لا يوجد عملاء</td>
                     </tr>
                     ";
            }
            $table.="
            </tbody>
            </table>
            ";
            echo $table;
            $filename="العملاء";
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=".$filename.".xls");
            header("Pragma: no-cache");
            header("Expires: 0");

    }


    public function pdf()
    {
        $clients=Client::
        leftJoin('system_constants as category_constants', function($join) {
            $join->on('category_constants.value', '=', 'clients.category')->where('category_constants.type','category')->whereNull('category_constants.deleted_at');
        })->leftJoin('system_constants as area_1_constants', function($join) {
            $join->on('area_1_constants.value', '=', 'clients.area_1')->where('area_1_constants.type','area_1')->whereNull('area_1_constants.deleted_at');
        })
        ->select('category_constants.name as category_name','area_1_constants.name as area_1_name','clients.id','clients.specialty_id','clients.category','clients.name','clients.item','clients.area_1','clients.status')
        ->with(['specialty','clientHits']);


        $pdf = LaravelMpdfuse::loadView('advan.admin.clients.table-data', $clients,
        [
            'mode'                       => '',
            'format'                     => 'A4',
            'default_font_size'          => '12',
            'default_font'               => 'sans-serif',
            'margin_left'                => 10,
            'margin_right'               => 10,
            'margin_top'                 => 10,
            'margin_bottom'              => 10,
            'margin_header'              => 0,
            'margin_footer'              => 0,
            'orientation'                => 'P',
            'title'                      => 'Laravel mPDF',
            'author'                     => '',
            'watermark'                  => '',
            'show_watermark'             => false,
            'show_watermark_image'       => false,
            'watermark_font'             => 'sans-serif',
            'display_mode'               => 'fullpage',
            'watermark_text_alpha'       => 0.1,
            'watermark_image_path'       => '',
            'watermark_image_alpha'      => 0.2,
            'watermark_image_size'       => 'D',
            'watermark_image_position'   => 'P',
            'custom_font_dir'            => '',
            'custom_font_data'           => [],
            'auto_language_detection'    => false,
            'temp_dir'                   => storage_path('app'),
            'pdfa'                       => false,
            'pdfaauto'                   => false,
            'use_active_forms'           => false,
        ]);

        return $pdf->stream('clients.pdf');
    }

}
