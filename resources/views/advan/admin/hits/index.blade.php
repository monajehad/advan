@extends('layouts.cpanel.app')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('cruds.hit.title_singular') }} {{ trans('global.list') }}
        <form method="get">
            <div class="row">
                <div class="col-6 form-group">
                    <label class="control-label" for="y">من</label>
                    <input class="form-control datetime  "  id="datetimepicker3" value="{{request()->get('from_date')}}" name="from_date"
                           type="text">
                </div>
                <div class="col-6 form-group">
                    <label class="control-label" for="m">الى</label>
                    <input class="form-control datetime  " id="datetimepicker4" value="{{request()->get('to_date')}}" name="to_date"
                           type="text">
                </div>

            </div>

            <div class="col-4">
                <label class="control-label">&nbsp;</label><br>
                <button class="btn btn-primary" type="submit">بحث</button>
            </div>
        </form>

    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Hit">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.hit.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.hit.fields.clinic') }}
                    </th>
                    <th>
                        {{ trans('cruds.hit.fields.date_time') }}
                    </th>
                    <th>
                        {{ trans('cruds.hit.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.hit.fields.type') }}
                    </th>
                    <th>
                        {{ trans('cruds.hit.fields.status') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
{{--                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">--}}
                    </td>
                    <td>
{{--                        <select class="search">--}}
{{--                            <option value>{{ trans('global.all') }}</option>--}}
{{--                            @foreach($clinics as $key => $item)--}}
{{--                                <option value="{{ $item->name }}">{{ $item->name }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
                    </td>
                    <td>
{{--                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">--}}
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($users as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\Hit::TYPE_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search" >
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\Hit::STATUS_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('hit_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.hits.massDestroy') }}",
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
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
      "ajax": {
          url: "{{route('admin.hits.index')}}",
          data: function (d) {
              d.from_date = $('#datetimepicker3').val();
              d.to_date   = $('#datetimepicker4').val();
          },
      },

    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'clinic_name', name: 'clinic.name' },
{ data: 'date_time', name: 'date_time' },
{ data: 'user_name', name: 'user.name' },
{ data: 'type', name: 'type' },
{ data: 'status', name: 'status' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 3, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Hit').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
});

</script>
@endsection
