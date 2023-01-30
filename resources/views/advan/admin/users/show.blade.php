@extends('layouts.cpanel.app')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.user.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>

                @if ($user->user_type == 'admin')
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div
                                        class="text-value">{{\App\Models\Hit::where('user_id' , $user->id)->count()}}</div>
                                    <div>عدد الزيارات الكلي</div>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div
                                        class="text-value">{{\App\Models\Sample::where('user_id' , $user->id)->count()}}</div>
                                    <div>عدد طلبات العينات</div>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div
                                        class="text-value">{{\App\Models\Sample::where('user_id' , $user->id)->where('status' , 2)->sum('quantity')}}</div>
                                    <div>عدد العينات المستلمة</div>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div
                                        class="text-value">{{\App\Models\Report::where('user_id' , $user->id)->count()}}</div>
                                    <div>عدد التقارير</div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            @endif
            <table class="table table-bordered table-striped">
                <tbody>
                <tr>
                    <th>
                        {{ trans('cruds.user.fields.id') }}
                    </th>
                    <td>
                        {{ $user->id }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.user.fields.name') }}
                    </th>
                    <td>
                        {{ $user->name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.user.fields.user_name') }}
                    </th>
                    <td>
                        {{ $user->user_name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.user.fields.email') }}
                    </th>
                    <td>
                        {{ $user->email }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.user.fields.phone') }}
                    </th>
                    <td>
                        {{ $user->phone }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.user.fields.email_verified_at') }}
                    </th>
                    <td>
                        {{ $user->email_verified_at }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.user.fields.roles') }}
                    </th>
                    <td>
                        @foreach($user->roles as $key => $roles)
                            <span class="label label-info">{{ $roles->title }}</span>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.user.fields.image') }}
                    </th>
                    <td>
                        @if($user->image)
                            <a href="{{$user->image_url}}" target="_blank" style="display: inline-block">
                                <img height="50" width="50" src="{{$user->image_url}}">
                            </a>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.user.fields.category') }}
                    </th>
                    <td>
                        @foreach($user->categories as $key => $category)
                            <span class="label label-info">{{ $category->name }}</span>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.user.fields.description') }}
                    </th>
                    <td>
                        {{ $user->description }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.user.fields.status') }}
                    </th>
                    <td>
                        {{ App\Models\User::STATUS_SELECT[$user->status] ?? '' }}
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
    </div>

    <div class="card">
        <div class="card-header">
            {{ trans('global.relatedData') }}
        </div>
        <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
            <li class="nav-item">
                <a class="nav-link" href="#user_user_alerts" role="tab" data-toggle="tab">
                    {{ trans('cruds.userAlert.title') }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="user_user_alerts">
                @includeIf('admin.users.relationships.userUserAlerts', ['userAlerts' => $user->userUserAlerts])
            </div>
        </div>
    </div>

@endsection
