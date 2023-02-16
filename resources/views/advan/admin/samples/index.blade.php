
@extends('layouts.cpanel.app')
@section('content')
<!--begin::Container-->
<div class="container">
    <div class="card card-custom gutter-b">
        <!--begin::Header-->
        <div class="card-header border-1 py-4">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">
               العينات
                </span>
            </h3>
            <div class="card-toolbar">
                {{-- @can('suppliers-add') --}}
                <a class="btn btn-success" href="{{ route('admin.samples.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.samples.title_singular') }}
                </a>                {{-- @endcan --}}
                {{-- @can('suppliers-export') --}}
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                {{-- @include('csvImport.modal', ['model' => 'sample-stocks', 'route' => 'admin.sample-stocks.parseCsvImport'])                @endcan --}}
            </div>
            <form method="get" action="{{url('admin/report')}}">
                <div class="row">
                    <div class="col-12 form-group">
                        <label class="control-label" for="m">المندوب</label>
                        <select class="form-control" name="user_name">
    {{--                        <option value="">اختر مندوب</option>--}}
                            @foreach($users as $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 form-group">
                        <label class="control-label" for="y">{{ trans('global.year') }}</label>
                        <select name="y" id="y" class="form-control">
                            @foreach(array_combine(range(date("Y"), 2000), range(date("Y"), 2000)) as $year)
                                <option value="{{ $year }}" @if($year===old('y', Request::get('y', date('Y')))) selected @endif>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3 form-group">
                        <label class="control-label" for="m">{{ trans('global.month') }}</label>
                        <select name="m" for="m" class="form-control">
                            @foreach(cal_info(0)['months'] as $month)
                                <option value="{{ $month }}" @if($month===old('m', Request::get('m', date('F')))) selected @endif>
                                    {{ month()[$month] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <label class="control-label">&nbsp;</label><br>
                        <button class="btn btn-primary" type="submit">عرض التقرير</button>
                    </div>
                </div>


            </form>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="row mt-4">
            <div class="col-md-4 col-lg-4 ml-8">
                <form class="form">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-sm" id="search_input" name="search_input"  placeholder="الاسم"/>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body py-0">
            <!--begin::Table-->
            <div class="sample-stocks-table-body">  @includeIf('advan.admin.samples.table-data')</div>

           <!--End::Table-->
        </div>
        <!--end::Body-->
    </div>

</div>
<!--end::Container-->
@endsection
@section('script')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
// @can('sample_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.samples.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
// @endcan



});

</script>
@endsection
