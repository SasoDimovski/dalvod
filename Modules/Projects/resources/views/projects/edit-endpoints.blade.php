@extends('admin/master')
@section('content')

    <?php
    $id_module = $module->id ?? '';
    $lang = request()->segment(2);
    $query = request()->getQueryString();


    $id = $project->id ?? '';
    $title = $project->title ?? old('title');
    $id_voltage = $project->id_voltage ?? old('id_voltage');
    $id_conductor = $project->id_conductor ?? old('id_conductor');
    $id_ground_wires = $project->id_ground_wires ?? old('id_ground_wires');
    $id_starting_point = $project->id_starting_point ?? old('id_starting_point');
    $id_ending_point = $project->id_ending_point ?? old('id_ending_point');
    $tensile_stress_cond = $project->tensile_stress_cond ?? old('tensile_stress_cond');
    $tensile_stress_ground = $project->tensile_stress_ground ?? old('tensile_stress_ground');
    $kn = $project->kn ?? old('kn');
    $ki = $project->ki ?? old('ki');
    $id_wind_pressure = $project->id_wind_pressure ?? old('id_wind_pressure');
    $id_insulator_chain = $project->id_insulator_chain ?? old('id_insulator_chain');
    $approx_field_length = $project->approx_field_length ?? old('approx_field_length');
    $approx_number_towers = $project->approx_number_towers ?? old('approx_number_towers');
    $num_cond_systems = $project->num_cond_systems ?? old('num_cond_systems');
    $num_cond_bundle = $project->num_cond_bundle ?? old('num_cond_bundle');
    $num_ground_wires = $project->num_ground_wires ?? old('num_ground_wires');


    $created_at = (isset($project->created_at)) ? date("d.m.Y H:i:s", strtotime($project->created_at)) : old('created_at');
    $updated_at = (isset($project->updated_at)) ? date("d.m.Y H:i:s", strtotime($project->updated_at)) : old('updated_at');


    $created_by = $project->created_by ?? old('created_by');
    $updated_by = $project->updated_by ?? old('updated_by');

    $active = $project->active ?? '';

    $url = url('admin/' . $lang . '/' . $module->link);

    $url_update_endpoints = $url . '/update_endpoints/'. $id;;
    $url_return_endpoints  =  $url . '/edit_endpoints/' . $id;

    $url_edit_towers = $url . '/towers';
    $url_edit_insulators = $url . '/insulators';

    $url_edit =  $url . '/edit';
    $url_edit_endpoints = $url . '/edit_endpoints';
    $url_edit_points = $url . '/edit_points';


    $url_edit_raspres = $url . '/edit_raspres';
    $url_edit_zatpol = $url . '/edit_zatpol';
    $url_edit_gapres = $url . '/edit_gapres';


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

        <section class="content">
            <div class="container-fluid">
                @include('admin._flash-message')
                @if (count($errors) > 0)
                    <div id="toast-container" class="toast-top-full-width" onclick="closeErrorWindow(this)"
                         style="width:100%" >

                        <div class="toast toast-error" aria-live="assertive" style="width:100%" >
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
                    @if($id)
                        @include('Projects::projects.edit-submenu')
                    @endif
                    <div class="col-sm-12 col-md-12 col-lg-8 col-xll-6">

                    <!-- Form-->
                    <form class="needs-validation" role="form" id="form_edit" name="form_edit"
                          action="{{ "{$url_update_endpoints}" }}" method="POST" enctype="multipart/form-data">

                        <input type="hidden" id="url_return" name="url_return" value="{{ $url_return_endpoints }}">
                        <input type="hidden" id="query" name="query" value="{{$query}}">
                        <input type="hidden" id="message_error" name="message_error" value="{{ $message_error }}">
                        <input type="hidden" id="message_success" name="message_success" value="{{ $message_success }}">
                        <input type="hidden" id="id" name="id" value="{{$id}}">
                        <input type="hidden" id="id_module" name="id_module" value="{{$id_module}}">
                        {{csrf_field()}}
                        @method('PUT')

                        <div class="card card">

                            <div class="card-header">
                                @if($active==0)
                                    &nbsp;<i class="fas fa-lock text-danger"
                                             title="{{__('global.deactivated')}}"></i>
                                @endif
                                <h3 class="card-title">  @if(isset($id)&&!empty($id))
                                        <b>{{$title}}</b>, id: {{$id}}
                                    @else
                                        {{__('global.new_record')}}
                                    @endif</h3>&nbsp;&nbsp;


                            </div>


                            <div class="card-body">
                                <!-- /.form -->
                                @if(count($trasa) > 0)
                                    @foreach($trasa as $trasa_)
                                        <input type="hidden" name="trasa[{{ $trasa_->id }}][id]"
                                               value="{{ $trasa_->id }}">
                                        @if($trasa_->id_trafo)
                                       {{--=========================================================================--}}
                                            <div class="row header-strip">
                                                <div class="col-sm-3">

                                                    @if ($loop->iteration == 1)
                                                        {{ __('projects.edit-endpoints.first') }}:
                                                    @elseif ($loop->iteration == 2)
                                                        {{ __('projects.edit-endpoints.end') }}:
                                                    @endif
                                                        <b style="text-transform: uppercase;">{{ __('projects.edit-endpoints.trafo') }}</b>, id: {{ $trasa_->id }}
                                                </div>
                                            </div>
                                            {{--=========================================================--}}
                                            <div class="row">
                                                <div class="col-sm-3">
                                                        <?php
                                                        $input_value = $trasa_->trafo->ime;
                                                        $input_name = "trafo[{$trasa_->id_trafo}][ime]";
                                                        $input_id = "trafo{$trasa_->id_trafo}_ime";
                                                        $input_desc = __('projects.edit-endpoints.ime');
                                                        $input_maxlength = 100;
                                                        $input_readonly = '';
                                                        $input_css = 'text-red';
                                                        $input_style = 'width: 80%;';
                                                        ?>
                                                    <div class="form-group">
                                                        <label for="{{$input_id}}"
                                                               class="{{$input_css}}">{{$input_desc}}
                                                            *</label>
                                                        <input type="text" id="{{$input_id}}" name="{{$input_name}}"
                                                               style="{{$input_style}}"
                                                               class="form-control" value="{{$input_value}}"
                                                               maxlength="{{$input_maxlength}}" {{$input_readonly}}>
                                                    </div>
                                                </div>
                                            </div>
                                            {{--=========================================================--}}
                                            <div class="row">
                                                <div class="col-sm-3">
                                                        <?php
                                                        $input_value = $trasa_->stac_t;
                                                        $input_name = "trasa[{$trasa_->id}][stac_t]";
                                                        $input_id = "trasa{$trasa_->id}_stac_t";
                                                        $input_desc = __('projects.edit-endpoints.stac_t');
                                                        $input_maxlength = 100;
                                                        $input_readonly = '';
                                                        $input_css = 'text-red';
                                                        $input_style = 'width: 80%;';
                                                        ?>
                                                    <div class="form-group">
                                                        <label for="{{$input_id}}"
                                                               class="{{$input_css}}">{{$input_desc}}
                                                            *</label>
                                                        <input type="text" id="{{$input_id}}" name="{{$input_name}}"
                                                               style="{{$input_style}}"
                                                               class="form-control" value="{{$input_value}}"
                                                               maxlength="{{$input_maxlength}}" {{$input_readonly}}>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                        <?php
                                                        $input_value = $trasa_->kota_t;
                                                        $input_name = "trasa[{$trasa_->id}][kota_t]";
                                                        $input_id = "trasa{$trasa_->id}_kota_t";
                                                        $input_desc = __('projects.edit-endpoints.kota_t');
                                                        $input_maxlength = 100;
                                                        $input_readonly = '';
                                                        $input_css = 'text-red';
                                                        $input_style = 'width: 80%;';
                                                        ?>
                                                    <div class="form-group">
                                                        <label for="{{$input_id}}"
                                                               class="{{$input_css}}">{{$input_desc}}
                                                            *</label>
                                                        <input type="text" id="{{$input_id}}" name="{{$input_name}}"
                                                               style="{{$input_style}}"
                                                               class="form-control" value="{{$input_value}}"
                                                               maxlength="{{$input_maxlength}}" {{$input_readonly}}>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                        <?php
                                                        $input_value = $trasa_->agol_tr;
                                                        $input_name = "trasa[{$trasa_->id}][agol_tr]";
                                                        $input_id = "trasa{$trasa_->id}_agol_tr";
                                                        $input_desc = __('projects.edit-endpoints.agol_tr');
                                                        $input_maxlength = 100;
                                                        $input_readonly = '';
                                                        $input_css = 'text-red';
                                                        $input_style = 'width: 80%;';
                                                        ?>
                                                    <div class="form-group">
                                                        <label for="{{$input_id}}"
                                                               class="{{$input_css}}">{{$input_desc}}
                                                            *</label>
                                                        <input type="text" id="{{$input_id}}" name="{{$input_name}}"
                                                               style="{{$input_style}}"
                                                               class="form-control" value="{{$input_value}}"
                                                               maxlength="{{$input_maxlength}}" {{$input_readonly}}>
                                                    </div>
                                                </div>

                                            </div>
                                            {{--=========================================================--}}
                                            <div class="row">
                                                <div class="col-sm-3">
                                                        <?php
                                                        $input_value = $trasa_->trafo->visna_p;
                                                        $input_name = "trafo[{$trasa_->id_trafo}][visna_p]";
                                                        $input_id = "trafo{$trasa_->id_trafo}_visna_p";
                                                        $input_desc = __('projects.edit-endpoints.visna_p');
                                                        $input_maxlength = 100;
                                                        $input_readonly = '';
                                                        $input_css = 'text-red';
                                                        $input_style = 'width: 80%;';
                                                        ?>
                                                    <div class="form-group">
                                                        <label for="{{$input_id}}"
                                                               class="{{$input_css}}">{{$input_desc}}
                                                            *</label>
                                                        <input type="text" id="{{$input_id}}" name="{{$input_name}}"
                                                               style="{{$input_style}}"
                                                               class="form-control" value="{{$input_value}}"
                                                               maxlength="{{$input_maxlength}}" {{$input_readonly}}>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                        <?php
                                                        $input_value = $trasa_->trafo->visina_zj;
                                                        $input_name = "trafo[{$trasa_->id_trafo}][visina_zj]";
                                                        $input_id = "trafo{$trasa_->id_trafo}_visina_zj";
                                                        $input_desc = __('projects.edit-endpoints.visina_zj');
                                                        $input_maxlength = 100;
                                                        $input_readonly = '';
                                                        $input_css = 'text-red';
                                                        $input_style = 'width: 80%;';
                                                        ?>
                                                    <div class="form-group">
                                                        <label for="{{$input_id}}"
                                                               class="{{$input_css}}">{{$input_desc}}
                                                            *</label>
                                                        <input type="text" id="{{$input_id}}" name="{{$input_name}}"
                                                               style="{{$input_style}}"
                                                               class="form-control" value="{{$input_value}}"
                                                               maxlength="{{$input_maxlength}}" {{$input_readonly}}>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                        <?php
                                                        $input_value = $trasa_->trafo->hor_ras;
                                                        $input_name = "trafo[{$trasa_->id_trafo}][hor_ras]";
                                                        $input_id = "trafo{$trasa_->id_trafo}_hor_ras";
                                                        $input_desc = __('projects.edit-endpoints.hor_ras');
                                                        $input_maxlength = 100;
                                                        $input_readonly = '';
                                                        $input_css = 'text-red';
                                                        $input_style = 'width: 80%;';
                                                        ?>
                                                    <div class="form-group">
                                                        <label for="{{$input_id}}"
                                                               class="{{$input_css}}">{{$input_desc}}
                                                            *</label>
                                                        <input type="text" id="{{$input_id}}" name="{{$input_name}}"
                                                               style="{{$input_style}}"
                                                               class="form-control" value="{{$input_value}}"
                                                               maxlength="{{$input_maxlength}}" {{$input_readonly}}>
                                                    </div>
                                                </div>
                                            </div>
                                            {{--=========================================================--}}
                                            <div class="row">
                                                <div class="col-sm-6">
                                                        <?php

                                                        $input_value_hidden = $trasa_->id_insulator1;
                                                        $input_name_hidden = "trasa[{$trasa_->id}][id_insulator1]";
                                                        $input_id_hidden = "trasa{$trasa_->id}_id_insulator1";

                                                        $input_value= $trasa_->insulator1 ? $trasa_->insulator1->type : '';
                                                        $input_name = "trasa[{$trasa_->id}][id_insulator1_]";
                                                        $input_id = "trasa{$trasa_->id}_id_insulator1_";


                                                        $input_desc = __('projects.edit-endpoints.id_insulator1');
                                                        $input_maxlength = 100;
                                                        $input_readonly = 'readonly';
                                                        $input_css = 'text-red';
                                                        $input_style = 'width: 40%;';

                                                        ?>
                                                    <div class="form-group">
                                                        <label for="{{ $input_id }}" class="{{ $input_css }}">
                                                            {{ $input_desc }} *
                                                        </label>

                                                        <div class="d-flex align-items-center">
                                                            <!-- INPUT -->
                                                            <input type="hidden"
                                                                   id="{{ $input_id_hidden }}"
                                                                   name="{{ $input_name_hidden }}"
                                                                   value="{{ $input_value_hidden }}"
                                                            >

                                                            <input type="text"
                                                                   id="{{ $input_id}}"
                                                                   name="{{ $input_name}}"
                                                                   class="form-control"
                                                                   value="{{ $input_value}}"
                                                                   maxlength="{{$input_maxlength}}"
                                                                   {{$input_readonly}}
                                                                   style="{{$input_style}}"
                                                            >
                                                            <!-- BUTTON 1 -->
                                                            <button type="button" class="btn btn-info ml-2 modal90"
                                                                    onclick="  getContentIDCustom('{{ $url_edit_insulators.'/'.$id }}?{{ $query ? $query.'&' : '' }}name=trasa'+{{$trasa_->id}}+'_id_insulator1&value='+ (document.getElementById('{{ $input_id_hidden }}').value || ''),'ModalShow','{{ __('projects.edit-endpoints.list_insulators') }}',true);">
                                                                {{ __('projects.edit-endpoints.chose_insulator') }}
                                                            </button>

                                                            <!-- BUTTON 2 -->
                                                            <button type="button" class="btn btn-danger ml-2" onclick=" deleteElementSelected('trasa'+{{$trasa_->id}}+'_id_insulator1')">
                                                                {{ __('projects.edit-endpoints.delete') }}
                                                            </button>
                                                        </div>
                                                    </div>


                                                </div>


                                            </div>
                                            {{--=========================================================--}}

                                        @else
                                            {{--=========================================================================--}}
                                            <div class="row header-strip">
                                                <div class="col-sm-3">
                                                    @if ($loop->iteration == 1)
                                                        {{ __('projects.edit-endpoints.first') }}:
                                                    @elseif ($loop->iteration == 2)
                                                        {{ __('projects.edit-endpoints.end') }}:
                                                    @endif
                                                    <b  style="text-transform: uppercase;">{{__('projects.edit-endpoints.tower')}}</b>, id: {{ $trasa_->id }}
                                                </div>
                                            </div>
                                            {{--=========================================================--}}
                                            <div class="row">
                                                <div class="col-sm-3">
                                                        <?php
                                                        $input_value = $trasa_->stac_t;
                                                        $input_name = "trasa[{$trasa_->id}][stac_t]";
                                                        $input_id = "trasa{$trasa_->id}_stac_t";
                                                        $input_desc = __('projects.edit-endpoints.stac_t');
                                                        $input_maxlength = 100;
                                                        $input_readonly = '';
                                                        $input_css = 'text-red';
                                                        $input_style = 'width: 80%;';
                                                        ?>
                                                    <div class="form-group">
                                                        <label for="{{$input_id}}"
                                                               class="{{$input_css}}">{{$input_desc}}
                                                            *</label>
                                                        <input type="text" id="{{$input_id}}" name="{{$input_name}}"
                                                               style="{{$input_style}}"
                                                               class="form-control" value="{{$input_value}}"
                                                               maxlength="{{$input_maxlength}}" {{$input_readonly}}>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                        <?php
                                                        $input_value = $trasa_->kota_t;
                                                        $input_name = "trasa[{$trasa_->id}][kota_t]";
                                                        $input_id = "trasa{$trasa_->id}_kota_t";
                                                        $input_desc = __('projects.edit-endpoints.kota_t');
                                                        $input_maxlength = 100;
                                                        $input_readonly = '';
                                                        $input_css = 'text-red';
                                                        $input_style = 'width: 80%;';
                                                        ?>
                                                    <div class="form-group">
                                                        <label for="{{$input_id}}"
                                                               class="{{$input_css}}">{{$input_desc}}
                                                            *</label>
                                                        <input type="text" id="{{$input_id}}" name="{{$input_name}}"
                                                               style="{{$input_style}}"
                                                               class="form-control" value="{{$input_value}}"
                                                               maxlength="{{$input_maxlength}}" {{$input_readonly}}>
                                                    </div>
                                                </div>

                                            </div>
                                            {{--=========================================================--}}
                                            <div class="row">
                                                <div class="col-sm-6">
                                                        <?php
                                                        $input_value_hidden = $trasa_->id_tower;
                                                        $input_name_hidden  = "trasa[{$trasa_->id}][id_tower]";
                                                        $input_id_hidden  = "trasa{$trasa_->id}_id_tower";

                                                        $input_value = $trasa_->tower ? $trasa_->tower->type : '';
                                                        $input_name = "trasa[{$trasa_->id}][id_tower_]";
                                                        $input_id  = "trasa{$trasa_->id}_id_tower_";

                                                        $input_desc = __('projects.edit-endpoints.tower_type');
                                                        $input_maxlength = 100;
                                                        $input_readonly = 'readonly';
                                                        $input_css = 'text-red';
                                                        $input_style = 'width: 40%;';
                                                        ?>

                                                    <div class="form-group">
                                                        <label for="{{ $input_id }}" class="{{ $input_css }}">
                                                            {{ $input_desc }} *
                                                        </label>

                                                        <div class="d-flex align-items-center">
                                                            <!-- INPUT -->
                                                            <input type="hidden"
                                                                   id="{{ $input_id_hidden }}"
                                                                   name="{{ $input_name_hidden }}"
                                                                   value="{{ $input_value_hidden }}"
                                                            >

                                                            <input type="text"
                                                                   id="{{ $input_id}}"
                                                                   name="{{ $input_name}}"
                                                                   class="form-control"
                                                                   value="{{ $input_value}}"
                                                                   maxlength="{{$input_maxlength}}"
                                                                   {{$input_readonly}}
                                                                   style="{{$input_style}}"
                                                            >

                                                            <!-- BUTTON 1 -->
                                                            <button type="button" class="btn btn-success ml-2 modal90"
                                                                    onclick="  getContentIDCustom('{{ $url_edit_towers.'/'.$id }}?{{ $query ? $query.'&' : '' }}name=trasa'+{{$trasa_->id}}+'_id_tower&value='+ (document.getElementById('{{ $input_id_hidden }}').value || ''),'ModalShow','{{ __('projects.edit-endpoints.list_towers') }}',true);">
                                                                {{ __('projects.edit-endpoints.chose_tower') }}
                                                            </button>

                                                            <!-- BUTTON 2 -->
                                                            <button type="button" class="btn btn-danger ml-2" onclick=" deleteElementSelected('trasa'+{{$trasa_->id}}+'_id_tower')">
                                                                {{ __('projects.edit-endpoints.delete') }}
                                                            </button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            {{--=========================================================--}}
                                            <div class="row">
                                                <div class="col-sm-6">
                                                        <?php

                                                        $input_value_hidden = $trasa_->id_insulator1;
                                                        $input_name_hidden = "trasa[{$trasa_->id}][id_insulator1]";
                                                        $input_id_hidden = "trasa{$trasa_->id}_id_insulator1";

                                                        $input_value= $trasa_->insulator1 ? $trasa_->insulator1->type : '';
                                                        $input_name = "trasa[{$trasa_->id}][id_insulator1_]";
                                                        $input_id = "trasa{$trasa_->id}_id_insulator1_";


                                                        $input_desc = __('projects.edit-endpoints.id_insulator1');
                                                        $input_maxlength = 100;
                                                        $input_readonly = 'readonly';
                                                        $input_css = 'text-red';
                                                        $input_style = 'width: 40%;';

                                                        ?>
                                                    <div class="form-group">
                                                        <label for="{{ $input_id }}" class="{{ $input_css }}">
                                                            {{ $input_desc }} *
                                                        </label>

                                                    <div class="d-flex align-items-center">
                                                            <!-- INPUT -->
                                                    <input type="hidden"
                                                           id="{{ $input_id_hidden }}"
                                                           name="{{ $input_name_hidden }}"
                                                           value="{{ $input_value_hidden }}"
                                                    >

                                                    <input type="text"
                                                           id="{{ $input_id}}"
                                                           name="{{ $input_name}}"
                                                           class="form-control"
                                                           value="{{ $input_value}}"
                                                           maxlength="{{$input_maxlength}}"
                                                           {{$input_readonly}}
                                                           style="{{$input_style}}"
                                                    >
                                                    <!-- BUTTON 1 -->
                                                    <button type="button" class="btn btn-info ml-2 modal90"
                                                            onclick="  getContentIDCustom('{{ $url_edit_insulators.'/'.$id }}?{{ $query ? $query.'&' : '' }}name=trasa'+{{$trasa_->id}}+'_id_insulator1&value='+ (document.getElementById('{{ $input_id_hidden }}').value || ''),'ModalShow','{{ __('projects.edit-endpoints.list_insulators') }}',true);">
                                                        {{ __('projects.edit-endpoints.chose_insulator') }}
                                                    </button>

                                                    <!-- BUTTON 2 -->
                                                    <button type="button" class="btn btn-danger ml-2" onclick=" deleteElementSelected('trasa'+{{$trasa_->id}}+'_id_insulator1',)">
                                                        {{ __('projects.edit-endpoints.delete') }}
                                                    </button>
                                                    </div>
                                                    </div>




                                                </div>


                                            </div>
                                            {{--=========================================================--}}

                                        @endif

                                    @endforeach
                                @endif

                            </div>

                        </div>


                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">

                                <button type="submit"
                                        class="btn btn-submit  btn-success check-duration float-right">{{__('global.save')}}</button>
                            </div>
                        </div>

                    </form>

                    </div>
                </div>


            </div>
        </section>
        <!-- /.Main content -->
    </div>
    <!-- /.Content Wrapper. Contains page content -->
@endsection










<style>


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
        .col-xll-6 {
            flex: 0 0 70%;
            max-width: 70%;
        }
    }
    .header-strip {
        background-color: #ffe187;
        padding:8px  2px;
        margin-bottom: 5px;
        /*font-weight: bold;*/
        border-radius: 4px; /* мал radius */
    }
</style>




