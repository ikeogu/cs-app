@extends('layouts.app')

@section('content')

  <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
          <div class="row ">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @elseif (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('danger') }}
                </div>

            @endif
           </div>
    </div>
    <div class="container-fluid mt--7">


        <!-- Table -->
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent pb-5">
                        <div class="text-muted text-center mt-2 mb-4"><small>{{ __('Add Product') }}</small></div>

                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <small>{{ __('Fill the form below') }}</small>
                        </div>
                        <form role="form" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group{{ $errors->has('file') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-image"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" type="file" name="image" value="{{ old('image') }}" autofocus>
                                </div>
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-basket"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}" type="text" name="title" value="{{ old('title') }}" required autofocus>
                                </div>
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('model') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-model-83"></i></span>
                                    </div>
                                    <select class="form-control" name="model">
                                        <option value="brand new">Brand New</option>
                                        <option value="fairly used">Fairly Used</option>
                                        <option value="tokumbo">Tukumbo</option>
                                    <select>
                                </div>
                                @if ($errors->has('model'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('model') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('size') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <select class="form-control" name="size">
                                        <option value="Small">Small</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Large">Large</option>
                                    <select>
                                </div>
                                @if ($errors->has('size'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('size') }}</strong>
                                    </span>
                                @endif
                            </div>
                             <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-credit-card"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" placeholder="{{ __('Price') }}" type="number" name="price" value="{{ old('price') }}" required autofocus>
                                </div>

                            </div>
                            <div class="form-group{{ $errors->has('color') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-bulb-61"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('color') ? ' is-invalid' : '' }}" placeholder="{{ __('Colour') }}" type="text" name="color" value="{{ old('color') }}"  autofocus>
                                </div>

                            </div>
                             <div class="form-group{{ $errors->has('discount') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-bulb-61"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('discount') ? ' is-invalid' : '' }}" placeholder="{{ __('% Discount') }}" type="number" name="color" value="{{ old('discount') }}"  autofocus>
                                </div>

                            </div>
                             <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                  <textarea name="description" class="form-control" cols="7" rows="5">

                                  </textarea>
                                </div>

                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4">{{ __('Add product') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
