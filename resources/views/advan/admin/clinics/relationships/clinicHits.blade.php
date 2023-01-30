@can('hit_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
{{--            <a class="btn btn-success" href="{{ route('admin.hits.create') }}">--}}
{{--                {{ trans('global.add') }} {{ trans('cruds.hit.title_singular') }}--}}
{{--            </a>--}}
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.hit.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-clinicHits">
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
                            {{ trans('cruds.hit.fields.duration_visit') }}
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
                </thead>
                <tbody>
                    @foreach($hits as $key => $hit)
                        <tr data-entry-id="{{ $hit->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $hit->id ?? '' }}
                            </td>
                            <td>
                                {{ $hit->clinic->name ?? '' }}
                            </td>
                            <td>
                                {{ $hit->date_time ?? '' }}
                            </td>
                            <td>
                                {{ $hit->duration_visit ?? '' }}
                            </td>
                            <td>
                                {{ $hit->user->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Hit::TYPE_SELECT[$hit->type] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Hit::STATUS_SELECT[$hit->status] ?? '' }}
                            </td>
                            <td>
                                @can('hit_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.hits.show', $hit->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('hit_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.hits.edit', $hit->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('hit_delete')
                                    <form action="{{ route('admin.hits.destroy', $hit->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('hit_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.hits.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
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

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-clinicHits:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
