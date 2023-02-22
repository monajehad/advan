@extends('layouts.cpanel.app')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.client.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.clients.update", [$client->id]) }}"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.client.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                           id="name" value="{{ old('name', $client->name) }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.client.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="" for="qualification">{{ trans('cruds.client.fields.qualification') }}</label>
                    <input class="form-control {{ $errors->has('qualification') ? 'is-invalid' : '' }}" type="text"
                           name="qualification" id="qualification" value="{{ old('qualification', $client->qualification) }}"
                           required
                           >
                    @if($errors->has('qualification'))
                        <div class="invalid-feedback">
                            {{ $errors->first('qualification') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.client.fields.qualification') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="specialty_id">{{ trans('cruds.client.fields.specialty') }}</label>
                    <select class="form-control select2 {{ $errors->has('specialty') ? 'is-invalid' : '' }}"
                            name="specialty_id" id="specialty_id" required>
                        @foreach($specialties as $id => $entry)
                            <option
                                value="{{ $id }}" {{ (old('specialty_id') ? old('specialty_id') : $client->specialty->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('specialty'))
                        <div class="invalid-feedback">
                            {{ $errors->first('specialty') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.client.fields.specialty_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="image">{{ trans('cruds.client.fields.image') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}"
                         id="image-dropzone">
                    </div>
                    @if($errors->has('image'))
                        <div class="invalid-feedback">
                            {{ $errors->first('image') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.client.fields.image_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="" for="email">{{ trans('cruds.client.fields.email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email"
                           id="email" value="{{ old('email', $client->email) }}" required>
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.client.fields.email_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="phone">{{ trans('cruds.client.fields.phone') }}</label>
                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone"
                           id="phone" value="{{ old('phone', $client->phone) }}" required>
                    @if($errors->has('phone'))
                        <div class="invalid-feedback">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.client.fields.phone_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="mobile">{{ trans('cruds.client.fields.mobile') }}</label>
                    <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text"
                           name="mobile" id="mobile"
                           value="{{ old('mobile', $client->mobile) }}">
                    @if($errors->has('mobile'))
                        <div class="invalid-feedback">
                            {{ $errors->first('mobile') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.client.fields.mobile_helper') }}</span>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <label>النوع</label>
                        <select class="form-control" id="category" name="category">
                        <?php    $categories=array('طبيب','صيدلية','مستشفى','مركز/جمعية')?>
                            <option value="" disabled selected>التصنيف </option>
                            @foreach($categories as $type)
                                <option value="{{$type}}"{{ ($client->category ??'') == $type ? 'selected':'' }}>  {{$type }}	</option>

                            @endforeach


                        </select>
                        <label class="form-text text-muted text-danger" id="unit-error"></label>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <label>التصنيف</label>
                            <select class="form-control" id="item" name="item">
                                <?php    $items=array('A','B','C','D')?>
                                <option value="" disabled selected>التصنيف </option>
                                @foreach($items as $item1)
                                    <option value="{{$item1}}" {{ ($client->item ??'') == $item1 ? 'selected':'' }}>  {{$item1 }}	</option>

                                @endforeach


                            </select>
                            <label class="form-text text-muted text-danger" id="unit-error"></label>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <label>المنطقة</label>
                                <select class="form-control" id="area_1" name="area_1">
                                    <?php    $areas_1=array('الشمال','غزة','الوسطى','الجنوب')?>
                                    <option value="" disabled selected>التصنيف </option>
                                    @foreach($areas_1 as $area_1)
                                        <option value="{{$area_1}}" {{ ($client->area_1 ??'') == $area_1 ? 'selected':'' }}>  {{$area_1 }}	</option>

                                    @endforeach


                                </select>
                                <label class="form-text text-muted text-danger" id="unit-error"></label>
                            </div>
                <div class="form-group">
                    <label for="address_1">{{ trans('cruds.client.fields.address_1') }}</label>
                    <input class="form-control {{ $errors->has('address_1') ? 'is-invalid' : '' }}" type="text"
                           name="address_1" id="address_1" value="{{ old('address_1', $client->address_1) }}">
                    @if($errors->has('address_1'))
                        <div class="invalid-feedback">
                            {{ $errors->first('address_1') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.client.fields.address_1_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="address_2">{{ trans('cruds.client.fields.address_2') }}</label>
                    <input class="form-control {{ $errors->has('address_2') ? 'is-invalid' : '' }}" type="text"
                           name="address_2" id="address_2" value="{{ old('address_2', $client->address_2) }}">
                    @if($errors->has('address_2'))
                        <div class="invalid-feedback">
                            {{ $errors->first('address_2') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.client.fields.address_2_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="address_3">{{ trans('cruds.client.fields.address_3') }}</label>
                    <input class="form-control {{ $errors->has('address_3') ? 'is-invalid' : '' }}" type="text"
                           name="address_3" id="address_3" value="{{ old('address_3', $client->address_3) }}">
                    @if($errors->has('address_3'))
                        <div class="invalid-feedback">
                            {{ $errors->first('address_3') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.client.fields.address_3_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required">{{ trans('cruds.client.fields.status') }}</label>
                    <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status"
                            id="status" required>
                        <option value
                                disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Client::STATUS_SELECT as $key => $label)
                            <option
                                value="{{ $key }}" {{ old('status', $client->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('status') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.client.fields.status_helper') }}</span>
                </div>


                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>

        </div>
    </div>



@endsection

@section('scripts')
    <script>
        Dropzone.options.imageDropzone = {
            url: '{{ route('admin.clients.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function (file, response) {
                $('form').find('input[name="image"]').remove()
                $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="image"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function () {
                @if(isset($client) && $client->image)
                var file = {!! json_encode($client->image) !!}
                this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
                this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiKdVyLzVz7aPyq832KYOQbqUm_4KZi2E&callback=initMap&libraries=places"
        defer></script>
    <script>
        let marker;

        function initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 13,
                center: {lat: 21.513513513513512, lng: 39.18008375438145},
            });

            marker = new google.maps.Marker({
                map: map,
                draggable: true,
                animation: google.maps.Animation.DROP,
                {{--icon : '{{url('local/public')}}/assets/images/zoccini.svg',--}}
                @if($client->latitude && $client->longitude)
                position: {lat: {{$client->latitude}}, lng: {{$client->longitude}} },
                @else
                position: {lat: 21.513513513513512, lng: 39.18008375438145},
                @endif
            });
            @if($client->latitude && $client->longitude)
            var home = {
                lat: {{$client->latitude}},
                lng: {{$client->longitude}}
            };

            map.setCenter(home);
            marker.setPosition(home);
            @endif
                @if(!$client->latitude)
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    map.setCenter(pos);
                    marker.setPosition(pos);
                    document.getElementById('lat').value = position.coords.latitude;
                    document.getElementById('lang').value = position.coords.longitude;
                }, function() {
                    //    handleLocationError(true, infoWindow, map.getCenter());
                });
            }
            @endif
            marker.addListener("dragend", toggleBounce);
        }

        /* google.maps.event.addListener(marker, 'dragend', function(event) {
              alert(event.latLng);
          }); */

        function toggleBounce(event) {
            var lat = document.getElementById('lat');
            var lang = document.getElementById('lang');
            lat.value = event.latLng.lat();
            lang.value = event.latLng.lng();
        }


    </script>
@endsection
