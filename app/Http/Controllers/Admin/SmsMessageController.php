<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySmsMessageRequest;
use App\Http\Requests\StoreSmsMessageRequest;
use App\Http\Requests\UpdateSmsMessageRequest;
use App\Models\SmsMessage;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SmsMessageController extends Controller
{
    const PAGINATION_NO=20;

    public function index(Request $request)
    {
        // abort_if(Gate::denies('sms_message_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $messages = SmsMessage::with(['user','client'])->select('title','message',
        'user_id',
        'client_id',
        'status',);

        $messages=$messages->orderBy('id','desc')->paginate(self::PAGINATION_NO);
        if ($request->ajax()) {
            $table_data=view('advan.admin.users.table-data',compact('messages'))->render();
            return response()->json(['messages'=>$table_data]);

         }
         $users = User::get();


        return view('advan.admin.smsMessages.index', compact('users','messages'));
    }

    public function create()
    {
        // abort_if(Gate::denies('sms_message_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctors = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.smsMessages.create', compact('users', 'doctors'));
    }

    public function store(StoreSmsMessageRequest $request)
    {
        $smsMessage = SmsMessage::create($request->all());

        return redirect()->route('admin.sms-messages.index');
    }

    public function edit(SmsMessage $smsMessage)
    {
        // abort_if(Gate::denies('sms_message_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctors = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $smsMessage->load('user', 'doctor');

        return view('admin.smsMessages.edit', compact('users', 'doctors', 'smsMessage'));
    }

    public function update(UpdateSmsMessageRequest $request, SmsMessage $smsMessage)
    {
        $smsMessage->update($request->all());

        return redirect()->route('admin.sms-messages.index');
    }

    public function show(SmsMessage $smsMessage)
    {
        // abort_if(Gate::denies('sms_message_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $smsMessage->load('user', 'doctor');

        return view('admin.smsMessages.show', compact('smsMessage'));
    }

    public function destroy(SmsMessage $smsMessage)
    {
        // abort_if(Gate::denies('sms_message_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');s

        $smsMessage->delete();

        return back();
    }

    public function massDestroy(MassDestroySmsMessageRequest $request)
    {
        SmsMessage::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
