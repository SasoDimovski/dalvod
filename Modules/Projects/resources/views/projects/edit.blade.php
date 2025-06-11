@extends('admin/master')
@section('content')

    <?php
    $id_module = $module->id ?? '';
    $lang = request()->segment(2);
    $query = request()->getQueryString();


    $id = $project->id ?? '';
    $title = $project->title ?? old('title');
    $id_voltage = $project->id_voltage ?? old('id_voltage');
    $id_conductor = $project->id_conductor  ?? old('id_conductor');
    $id_ground_wires = $project->id_ground_wires  ?? old('id_ground_wires');
    $id_starting_point = $project->id_starting_point  ?? old('id_starting_point');
    $id_ending_point = $project->id_ending_point  ?? old('id_ending_point');
    $tensile_stress_cond = $project->tensile_stress_cond  ?? old('tensile_stress_cond');
    $tensile_stress_ground = $project->tensile_stress_ground  ?? old('tensile_stress_ground');
    $kn = $project->kn  ?? old('kn');
    $ki = $project->ki  ?? old('ki');
    $id_wind_pressure = $project->id_wind_pressure  ?? old('id_wind_pressure');
    $id_insulator_chain = $project->id_insulator_chain  ?? old('id_insulator_chain');
    $approx_field_length = $project->approx_field_length  ?? old('approx_field_length');
    $approx_number_towers = $project->approx_number_towers  ?? old('approx_number_towers');
    $num_cond_systems = $project->num_cond_systems  ?? old('num_cond_systems');
    $num_cond_bundle = $project->num_cond_bundle  ?? old('num_cond_bundle');
    $num_ground_wires = $project->num_ground_wires  ?? old('num_ground_wires');


    $created_at = (isset($project->created_at)) ? date("d.m.Y H:i:s", strtotime($project->created_at)) : old('created_at');
    $updated_at = (isset($project->updated_at)) ? date("d.m.Y H:i:s", strtotime($project->updated_at)) : old('updated_at');


    $created_by = $project->created_by ?? old('created_by');
    $updated_by= $project->updated_by ?? old('updated_by');

    $active = $project->active ?? '';

    $url_base = 'admin/' . $lang . '/' . $module->link;

    $url = url($url_base);
    $url_store = url($url_base.'/store/');
    $url_update = url($url_base.'/update/' . $id);
    $url_action = !empty($id) ? $url_update : $url_store;
    $url_return = url($url_base.'/edit/' . $id);

    $path_upload = 'uploads/projects/';

    $message_error = (isset($id)) ? __('global.update_error') : __('global.save_error');
    $message_success = (isset($id)) ? __('global.update_success') : __('global.save_success');


    ?>


        <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fa {{$module->design->icon}}"></i> {{$module->title }} </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{$url}}">{{$module->title }}</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- / Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @include('admin._flash-message')
                @if (count($errors) > 0)
                    <div id="toast-container" class="toast-top-full-width" onclick="closeErrorWindow(this)"
                         style="width:100%" ;>

                        <div class="toast toast-error" aria-live="assertive" style="width:100%" ;>
                            <div class="toast-progress" style="width:100%;"></div>
                            <button type="button" class="close" data-dismiss="toast-top-full-width"
                                    role="button" onclick="closeErrorWindow(this)">×
                            </button>
                            <p><strong>{{__('global.error_not')}}</strong></p>
                            <div class="toast-message">
                                @foreach ($errors->all() as $error)
                                    <div class="callout callout-danger"
                                         style="color: #0a0a0a!important;padding: 5px!important;">
                                        {!! $error !!}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xll-6">
                        <!-- Form-->
                        <form class="needs-validation" role="form" id="form_edit" name="form_edit"
                              action="{{ "{$url_action}" }}" method="POST" enctype="multipart/form-data">

                            <input type="hidden" id="url_return" name="url_return" value="{{ $url_return }}">
                            <input type="hidden" id="query" name="query" value="{{$query}}">
                            <input type="hidden" id="message_error" name="message_error" value="{{ $message_error }}">
                            <input type="hidden" id="message_success" name="message_success" value="{{ $message_success }}">
                            <input type="hidden" id="id" name="id" value="{{ $id}}">
                            <input type="hidden" id="id_module" name="id_module" value="{{ $id_module}}">
                            {{csrf_field()}}
                            @method('PUT')


                            <div class="card card">

                                <div class="card-header">
                                    @if($active==0)
                                        &nbsp;<i class="fas fa-lock text-danger"
                                                 title="{{__('global.deactivated')}}"></i>
                                    @endif
                                    <h3 class="card-title">  @if(isset($id)&&!empty($id))
                                            id: {{$id}}
                                        @else
                                            {{__('global.new_record')}}
                                        @endif</h3>&nbsp;&nbsp;


                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <?php
                                            $input_value = $active;
                                            $input_name = 'active';
                                            $input_desc = __('projects.active');
                                            $input_readonly = '';
                                            $input_css = 'text';
                                            ?>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox"
                                                           id="{{$input_name}}"
                                                           name="{{$input_name}}"
                                                           value="1" @if($input_value==1||$input_value=='') {{'checked'}} @endif {{$input_readonly}}>
                                                    <label class="custom-control-label" for="{{$input_name}}"
                                                    {{$input_css}} id="{{$input_name}}">{{$input_desc}}</label>
                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                    {{--=========================================================--}}
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <?php
                                            $input_value = $title;
                                            $input_name = 'title';
                                            $input_desc = __('projects.title');
                                            $input_maxlength = 200;
                                            $input_readonly = '';
                                            $input_css = 'text-red';
                                            ?>
                                            <div class="form-group">
                                                <label for="{{$input_name}}" class="{{$input_css}}">{{$input_desc}}
                                                    *</label>
                                                <input type="text" id="{{$input_name}}" name="{{$input_name}}"
                                                       class="form-control" value="{{$input_value}}"
                                                       maxlength="{{$input_maxlength}}" {{$input_readonly}}>
                                            </div>
                                        </div>

                                    </div>
                                    {{--=========================================================--}}
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <?php

                                            $input_value = $id_voltage;
                                            $input_name = 'id_voltage';
                                            $input_desc = __('projects.id_voltage');
                                            $input_readonly = '';
                                            $input_css = 'text-red';
                                            ?>
                                            <div class="form-group">
                                               <label class="{{ $input_css }}">{{ $input_desc }} *</label>
                                                <select class="select2bs4"
                                                        id="{{ $input_name }}" name="{{ $input_name }}"
                                                        autocomplete="off" {{ $input_readonly }}>
                                                    @if (count($voltages) > 0)
                                                        <option value="">&nbsp;</option>
                                                        @foreach ($voltages as $voltage)
                                                            <option
                                                                value="{{ $voltage->id }}"
                                                                {{ (($id_voltage)==$voltage->id) ? 'selected' : '' }}>
                                                                {{ $voltage->title }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-sm-3">
                                            <?php

                                            $input_value = $id_starting_point;
                                            $input_name = 'id_starting_point';
                                            $input_desc = __('projects.id_starting_point');
                                            $input_readonly = '';
                                            $input_css = 'text-red';
                                            $input_style = 'width:100%;';
                                            ?>
                                            <div class="form-group">
                                                <label class="{{ $input_css }}">{{ $input_desc }} *</label>
                                                <select class="select2bs4"
                                                        id="{{ $input_name }}" name="{{ $input_name }}"  style="{{$input_style}}"
                                                        autocomplete="off" {{ $input_readonly }}>
                                                    @if (count($endpoints) > 0)
                                                        <option value="">&nbsp;</option>
                                                        @foreach ($endpoints as $endpoint)
                                                            <option
                                                                value="{{ $endpoint->id }}"
                                                                {{ (($id_starting_point)==$endpoint->id) ? 'selected' : '' }}>
                                                                {{ $endpoint->title }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-sm-3">
                                            <?php

                                            $input_value = $id_ending_point;
                                            $input_name = 'id_ending_point';
                                            $input_desc = __('projects.id_ending_point');
                                            $input_readonly = '';
                                            $input_css = 'text-red';
                                            $input_style = 'width:100%;';
                                            ?>
                                            <div class="form-group">
                                                <label class="{{ $input_css }}">{{ $input_desc }} *</label>
                                                <select class="select2bs4"
                                                        id="{{ $input_name }}" name="{{ $input_name }}"  style="{{$input_style}}"
                                                        autocomplete="off" {{ $input_readonly }}>
                                                    @if (count($endpoints) > 0)
                                                        <option value="">&nbsp;</option>
                                                        @foreach ($endpoints as $endpoint)
                                                            <option
                                                                value="{{ $endpoint->id }}"
                                                                {{ (($id_ending_point)==$endpoint->id) ? 'selected' : '' }}>
                                                                {{ $endpoint->title }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                    {{--=========================================================--}}
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <?php

                                            $input_value = $id_conductor;
                                            $input_name = 'id_conductor';
                                            $input_desc = __('projects.id_conductor');
                                            $input_readonly = '';
                                            $input_css = 'text-red';
                                            $input_style = 'width:100%;';
                                            ?>
                                            <div class="form-group">
                                                <label class="{{ $input_css }}">{{ $input_desc }} *</label>
                                                <select class="select2bs4"
                                                        id="{{ $input_name }}" name="{{ $input_name }}" style="{{$input_style}}"
                                                        autocomplete="off" {{ $input_readonly }}>
                                                    @if (count($conductors) > 0)
                                                        <option value="">&nbsp;</option>
                                                        @foreach ($conductors as $conductor)
                                                            <option
                                                                value="{{ $conductor->id }}"
                                                                {{ (($id_conductor)==$conductor->id) ? 'selected' : '' }}>
                                                                {{ $conductor->type }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-sm-6">
                                            <?php
                                            $input_value = $tensile_stress_cond ;
                                            $input_name = 'tensile_stress_cond';
                                            $input_desc = __('projects.tensile_stress_cond');
                                            $input_maxlength = 5;
                                            $input_readonly = '';
                                            $input_css = 'text-red';
                                            $input_style = 'width: 20%;';
                                            ?>
                                            <div class="form-group">
                                                <label for="{{$input_name}}" class="{{$input_css}}">{{$input_desc}}
                                                    *</label>
                                                <input type="text" id="{{$input_name}}" name="{{$input_name}}" style="{{$input_style}}"
                                                       class="form-control" value="{{$input_value}}"
                                                       maxlength="{{$input_maxlength}}" {{$input_readonly}}>
                                            </div>
                                        </div>


                                    </div>
                                    {{--=========================================================--}}
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <?php

                                            $input_value = $id_ground_wires;
                                            $input_name = 'id_ground_wires';
                                            $input_desc = __('projects.id_ground_wires');
                                            $input_readonly = '';
                                            $input_css = 'text-red';
                                            $input_style = 'width:100%;';

                                            ?>
                                            <div class="form-group">
                                                <label class="{{ $input_css }}">{{ $input_desc }} *</label>
                                                <select class="select2bs4"
                                                        id="{{ $input_name }}" name="{{ $input_name }}" style="{{$input_style}}"
                                                        autocomplete="off" {{ $input_readonly }}>
                                                    @if (count($groundWires) > 0)
                                                        <option value="">&nbsp;</option>
                                                        @foreach ($groundWires as $groundWire)
                                                            <option
                                                                value="{{ $groundWire->id }}"
                                                                {{ (($id_ground_wires)==$groundWire->id) ? 'selected' : '' }}>
                                                                {{ $groundWire->type }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-sm-6">
                                            <?php
                                            $input_value = $tensile_stress_ground ;
                                            $input_name = 'tensile_stress_ground';
                                            $input_desc = __('projects.tensile_stress_ground');
                                            $input_maxlength = 5;
                                            $input_readonly = '';
                                            $input_css = 'text-red';
                                            $input_style = 'width: 20%;';
                                            ?>
                                            <div class="form-group">
                                                <label for="{{$input_name}}" class="{{$input_css}}">{{$input_desc}}
                                                    *</label>
                                                <input type="text" id="{{$input_name}}" name="{{$input_name}}"  style="{{$input_style}}"
                                                       class="form-control" value="{{$input_value}}"
                                                       maxlength="{{$input_maxlength}}" {{$input_readonly}}>
                                            </div>
                                        </div>


                                    </div>
                                    {{--=========================================================--}}
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <?php
                                            $input_value = $kn;
                                            $input_name = 'kn';
                                            $input_desc = __('projects.kn');
                                            $input_maxlength = 5;
                                            $input_readonly = '';
                                            $input_css = 'text-red';
                                            $input_style = 'width: 20%;';
                                            ?>
                                            <div class="form-group">
                                                <label for="{{$input_name}}" class="{{$input_css}}">{{$input_desc}}
                                                    *</label>
                                                <input type="text" id="{{$input_name}}" name="{{$input_name}}"  style="{{$input_style}}"
                                                       class="form-control" value="{{$input_value}}"
                                                       maxlength="{{$input_maxlength}}" {{$input_readonly}}>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-sm-6">
                                            <?php
                                            $input_value = $ki;
                                            $input_name = 'ki';
                                            $input_desc = __('projects.ki');
                                            $input_maxlength = 5;
                                            $input_readonly = '';
                                            $input_css = 'text-red';
                                            $input_style = 'width: 20%;';
                                            ?>
                                            <div class="form-group">
                                                <label for="{{$input_name}}" class="{{$input_css}}">{{$input_desc}}
                                                    *</label>
                                                <input type="text" id="{{$input_name}}" name="{{$input_name}}"  style="{{$input_style}}"
                                                       class="form-control" value="{{$input_value}}"
                                                       maxlength="{{$input_maxlength}}" {{$input_readonly}}>
                                            </div>
                                        </div>
                                    </div>

                                    {{--=========================================================--}}
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <?php

                                            $input_value = $id_wind_pressure;
                                            $input_name = 'id_wind_pressure';
                                            $input_desc = __('projects.id_wind_pressure');
                                            $input_readonly = '';
                                            $input_css = 'text-red';

                                            ?>
                                            <div class="form-group">
                                                <label class="{{ $input_css }}">{{ $input_desc }} *</label>
                                                <select class="select2bs4"
                                                        id="{{ $input_name }}" name="{{ $input_name }}"
                                                        autocomplete="off" {{ $input_readonly }}>
                                                    @if (count($windPressure) > 0)
                                                        <option value="">&nbsp;</option>
                                                        @foreach ($windPressure as $windPressure_)
                                                            <option
                                                                value="{{ $windPressure_->id }}"
                                                                {{ (($id_wind_pressure)==$windPressure_->id) ? 'selected' : '' }}>
                                                                {{ $windPressure_->title }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                        </div>
                                        </div>

                                        <div class="row">
                                        <div class="col-sm-4">
                                            <?php

                                            $input_value = $id_insulator_chain;
                                            $input_name = 'id_insulator_chain';
                                            $input_desc = __('projects.id_insulator_chain');
                                            $input_readonly = '';
                                            $input_css = 'text-red';

                                            ?>
                                            <div class="form-group">
                                                <label class="{{ $input_css }}">{{ $input_desc }} *</label>
                                                <select class="select2bs4"
                                                        id="{{ $input_name }}" name="{{ $input_name }}"
                                                        autocomplete="off" {{ $input_readonly }}>
                                                    @if (count($insulatorChain) > 0)
                                                        <option value="">&nbsp;</option>
                                                        @foreach ($insulatorChain as $insulatorChain_)
                                                            <option
                                                                value="{{ $insulatorChain_->id }}"
                                                                {{ (($id_insulator_chain)==$insulatorChain_->id) ? 'selected' : '' }}>
                                                                {{ $insulatorChain_->title }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                        </div>


                                    </div>
                                    {{--=========================================================--}}
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <?php

                                            $input_value = $num_cond_systems;
                                            $input_name = 'num_cond_systems';
                                            $input_desc = __('projects.num_cond_systems');
                                            $input_readonly = '';
                                            $input_css = 'text-red';

                                            ?>
                                            <div class="form-group">
                                                <label class="{{ $input_css }}">{{ $input_desc }} *</label>
                                                <select class="select2bs4"
                                                        id="{{ $input_name }}" name="{{ $input_name }}"
                                                        autocomplete="off" {{ $input_readonly }}>

                                                        <option value="">&nbsp;</option>
                                                        <option value="1" {{ ($num_cond_systems)==1 ? 'selected' : '' }}>1</option>
                                                        <option value="2" {{ ($num_cond_systems)==2 ? 'selected' : '' }}>2</option>
                                                        <option value="3" {{ ($num_cond_systems)==3 ? 'selected' : '' }}>3</option>
                                                        <option value="4" {{ ($num_cond_systems)==4 ? 'selected' : '' }}>4</option>


                                                </select>
                                            </div>

                                        </div>

                                        <div class="col-sm-4">
                                            <?php

                                            $input_value = $num_cond_bundle;
                                            $input_name = 'num_cond_bundle';
                                            $input_desc = __('projects.num_cond_bundle');
                                            $input_readonly = '';
                                            $input_css = 'text-red';

                                            ?>
                                            <div class="form-group">
                                                <label class="{{ $input_css }}">{{ $input_desc }} *</label>
                                                <select class="select2bs4"
                                                        id="{{ $input_name }}" name="{{ $input_name }}"
                                                        autocomplete="off" {{ $input_readonly }}>
                                                    <option value="">&nbsp;</option>
                                                    <option value="1" {{ ($num_cond_bundle)==1 ? 'selected' : '' }}>1</option>
                                                    <option value="2" {{ ($num_cond_bundle)==2 ? 'selected' : '' }}>2</option>
                                                    <option value="3" {{ ($num_cond_bundle)==3 ? 'selected' : '' }}>3</option>
                                                    <option value="4" {{ ($num_cond_bundle)==4 ? 'selected' : '' }}>4</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-sm-4">
                                            <?php

                                            $input_value = $num_ground_wires;
                                            $input_name = 'num_ground_wires';
                                            $input_desc = __('projects.num_ground_wires');
                                            $input_readonly = '';
                                            $input_css = 'text-red';

                                            ?>
                                            <div class="form-group">
                                                <label class="{{ $input_css }}">{{ $input_desc }} *</label>
                                                <select class="select2bs4"
                                                        id="{{ $input_name }}" name="{{ $input_name }}"
                                                        autocomplete="off" {{ $input_readonly }}>
                                                    <option value="">&nbsp;</option>
                                                    <option value="1" {{ ($num_ground_wires)==1 ? 'selected' : '' }}>1</option>
                                                    <option value="2" {{ ($num_ground_wires)==2 ? 'selected' : '' }}>2</option>
                                                </select>
                                            </div>

                                        </div>

                                    </div>
                                    {{--=========================================================--}}
                                    <button type="button" onclick="form_edit.submit();"
                                            class="btn btn-success float-right">{{__('global.save')}}</button>
                                </div>
                                <!-- /.card-body -->

{{--                                <div class="card-footer">--}}
{{--                                  --}}
{{--                                </div>--}}
                                <!-- /.card-footer -->
                            </div>
                            <!-- /.card -->


                            <!-- /.col-md-12 -->

                            <!-- /.row-->
                        </form>
                        <!-- /.form -->
                    </div>




                </div>

                <!-- /.row-->



            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.Main content -->


    </div>
    <!-- /.Content Wrapper. Contains page content -->
@endsection

@section('additional_css')

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url('LTE/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ url('LTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- date-range-picker -->
    <link rel="stylesheet" href="{{ url('LTE/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ url('LTE/plugins/toastr/toastr.min.css')}}">


    <style>
        .daterangepicker.single .drp-buttons {
            display: block !important;
        }
        .target-cell {
            display: none;
        }

        @media (max-width: 1400px) {
            .source-cell {
                display: none;
            }

            .target-cell {
                display: table-cell;
            }
        }
        @media (min-width: 1300px) {
            .col-xll-6{
                flex: 0 0 70%;
                max-width: 70%;
            }
        }
    </style>
@endsection

@section('additional_js')

    <!-- Select2 -->
    <script src="{{url('LTE/plugins/select2/js/select2.full.min.js')}}"></script>

    {{--    FOR DATE INPUT FIELD////////////////////////////////////////////////////////////////////////////////////////////////////////--}}
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{url('LTE/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
    <!-- InputMask -->
    <script src="{{url('LTE/plugins/moment/moment.min.js')}}"></script>
    <script src="{{url('LTE/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
    <!-- date-range-picker -->
    <script src="{{url('LTE/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{url('LTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    {{--    .END FOR DATE INPUT FIELD////////////////////////////////////////////////////////////////////////////////////////////////////////--}}

    <script>

        $(document).ready(function () {
            // Иницијализација на bsCustomFileInput
            bsCustomFileInput.init();

            // Конфигурација за Date Range Picker со вклучено време
            const dateTimePickerConfig = {
                singleDatePicker: true,
                autoUpdateInput: false,
                timePicker: false, // Овозможете време
                timePicker24Hour: true, // 24-часовен формат
                timePickerSeconds: true, // Вклучете секунди
                showDropdowns: true,
                locale: {
                    format: "DD.MM.YYYY HH:mm:ss", // Формат за датум и време
                    // applyLabel: "Внеси",
                    // cancelLabel: "Бриши",
                    fromLabel: "From",
                    toLabel: "To",
                    customRangeLabel: "Custom",
                    weekLabel: "W",
                    // daysOfWeek: ["Не", "По", "Вт", "Ср", "Че", "Пе", "Са"],
                    // monthNames: [
                    //     "Јануари", "Февруари", "Март", "Април", "Мај", "Јуни",
                    //     "Јули", "Август", "Септември", "Октомври", "Ноември", "Декември"
                    // ],
                    firstDay: 1
                }
            };

            // Функција за иницијализација на Date Range Picker за дадено поле
            function initializeDateTimePicker(selector) {
                const inputField = $(selector);

                inputField.daterangepicker(dateTimePickerConfig);

                inputField.on('apply.daterangepicker', function (ev, picker) {
                    // Поставување на времето на 23:59:59 за end_date
                    // if (selector.includes('end_date')) {
                    //     const endOfDay = picker.startDate.clone().set({
                    //         hour: 23,
                    //         minute: 59,
                    //         second: 59
                    //     });
                    //     picker.setStartDate(endOfDay);  // Поставување нов датум со крај на денот
                    // }
                    // Форматирање и пополнување на полето
                    $(this).val(picker.startDate.format('DD.MM.YYYY HH:mm:ss'));
                    $('#start_date_hidden').val(picker.startDate.format('DD.MM.YYYY HH:mm:ss'));
                });

                inputField.on('cancel.daterangepicker', function () {
                    $(this).val('');
                });
            }
            // Функција за end_date која секогаш го поставува времето на 23:59:59
            function initializeEndDateTimePicker(selector) {
                const inputField = $(selector);

                inputField.daterangepicker(dateTimePickerConfig);

                inputField.on('apply.daterangepicker', function (ev, picker) {
                    // Присилно поставување на 23:59:59 за end_date
                    picker.startDate.set({
                        hour: 23,
                        minute: 59,
                        second: 59
                    });
                    $(this).val(picker.startDate.format('DD.MM.YYYY HH:mm:ss'));
                    $('#end_date_hidden').val(picker.startDate.format('DD.MM.YYYY HH:mm:ss'));
                });

                inputField.on('cancel.daterangepicker', function () {
                    $(this).val('');
                });
            }
            // Иницијализација за `start_date`
            initializeDateTimePicker('input[name="start_date"]');
            // Иницијализација за `end_date` (ако е потребно)
            initializeEndDateTimePicker('input[name="end_date"]');
        });



        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4',
            //dropdownAutoWidth: true,
            //width: 'auto'
        })


    </script>

@endsection
