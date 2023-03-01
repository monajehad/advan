<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyClientsSpecialtyRequest;
use App\Http\Requests\StoreClientsSpecialtyRequest;
use App\Http\Requests\UpdateClientsSpecialtyRequest;
use App\Models\ClientsSpecialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ClientsSpecialtiesController extends Controller
{
   const PAGINATION_NO=20;

    use CsvImportTrait;

    public function index(Request $request)
    {
        // abort_if(Gate::denies('clients_specialty_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients_specialt=ClientsSpecialty::select('id','name','status');
        if($request->search){
            $clients_specialt=$clients_specialt->where('name','like','%'.$request->search.'%');
        }
        $clients_specialt=$clients_specialt->orderBy('id','desc')->paginate(self::PAGINATION_NO);
        if ($request->ajax()) {
            $table_data=view('advan.admin.clientsSpecialties.table-data',compact('clients_specialt'))->render();
            return response()->json(['clients_specialt'=>$table_data]);

        }
        return view('advan.admin.clientsSpecialties.index',compact('clients_specialt'));


    }

    public function create()
    {
        // abort_if(Gate::denies('clients_specialty_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('advan.admin.clientsSpecialties.create');
    }

    public function store(StoreClientsSpecialtyRequest $request)
    {
        $clientsSpecialty = ClientsSpecialty::create($request->all());

        return redirect()->route('admin.clients-specialties.index');
    }

    public function edit(ClientsSpecialty $clientsSpecialty)
    {
        // abort_if(Gate::denies('clinics_specialty_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('advan.admin.clientsSpecialties.edit', compact('clientsSpecialty'));
    }

    public function update(UpdateClientsSpecialtyRequest $request, ClientsSpecialty $clientsSpecialty)
    {
        $clientsSpecialty->update($request->all());

        return redirect()->route('admin.clients-specialties.index');
    }

    public function show(ClientsSpecialty $clientsSpecialty)
    {
        // abort_if(Gate::denies('clients_specialty_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('advan.admin.clientsSpecialties.show', compact('clientsSpecialty'));
    }

    public function destroy(Request $request)
    {
        if(!$request->id)
        return response()->json(['status'=>false,'error'=>'لم يتم تحديد نوع العميل']);
        $clientsSpecialty=ClientsSpecialty::where('id',$request->id)->first();
       if(!$clientsSpecialty)
        return response()->json(['status'=>false,'error'=>'نوع العميل غير موجود']);
       $delete=$clientsSpecialty->delete();
       if(!$delete)
        return response()->json(['status'=>false,'error'=>'لم يتم حذف نوع العميل']);
       return response()->json(['status'=>true,'success'=>'تم حذف نوع العميل بنجاح']);


    //    return redirect()->route('admin.clients-specialties.index');



    }

    public function massDestroy(MassDestroyClientsSpecialtyRequest $request)
    {
        ClientsSpecialty::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
