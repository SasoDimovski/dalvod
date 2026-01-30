@extends('admin/master')
@section('content')

    <?php
    $id_module = $module->id ?? '';
    $lang = request()->segment(2);
    $query = request()->getQueryString();

    $id = $tower->id ?? '';


    $sif = $tower->sif ?? old('sif');
    $type = $tower->type ?? old('type');
    $voltage = $tower->voltage ?? old('voltage');
    $angle= $tower->angle ?? old('angle');
    $mass = $tower->mass ?? old('mass');
    $vid = $tower->vid ?? old('vid');
    $vis  = $tower->vis  ?? old('vis');
    $vig = $tower->vig ?? old('vig');
    $mhr = $tower->mhr ?? old('mhr');
    $dkp = $tower->dkp ?? old('dkp');
    $dkz= $tower->dkz ?? old('dkz');
    $rap = $tower->rap ?? old('rap');
    $raz= $tower->raz ?? old('raz');
    $picture = $tower->picture ?? old('picture');



    $active = $tower->active ?? '';
    $deleted = $tower->deleted ?? '';
    $created_at = (isset($tower->created_at)) ? date("d.m.Y  H:i:s", strtotime($tower->created_at)) : '';
    $updated_at = (isset($tower->updated_at)) ? date("d.m.Y  H:i:s", strtotime($tower->updated_at)) : '';
    $created_by = ($tower->createdBy?->username . ', ' . $tower->createdBy?->name . ' ' . $tower->createdBy?->surname) ?: '';
    $updated_by = ($tower->updatedBy?->username . ', ' . $tower->updatedBy?->name . ' ' . $tower->updatedBy?->surname) ?: '';

    $url = url('admin/' . $lang . '/' . $module->link);

    $url_store =  $url . '/store';
    $url_update =  $url . '/update/'. $id;
    $url_action = !empty($id) ? $url_update : $url_store;
    $url_return =  $url . '/edit/' . $id;


    $path_upload = 'uploads/towers/';

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

                <!-- Form-->
                <form class="needs-validation" role="form" id="form_edit" name="form_edit"
                      action="{{ "{$url_action}" }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" id="url_return" name="url_return" value="{{ $url_return }}">
                    <input type="hidden" id="query" name="query" value="{{$query}}">
                    <input type="hidden" id="message_error" name="message_error" value="{{ $message_error }}">
                    <input type="hidden" id="message_success" name="message_success" value="{{ $message_success }}">

                    <input type="hidden" id="id" name="id" value="{{ $id}}">
                    <input type="hidden" id="id_module" name="id_module" value="{{ $id_module}}">
                    {{csrf_field()}}
                    @method('PUT')

                    <div class="row">


                        <div class="col-sm-12 col-md-12  col-lg-6 col-xl-6">

                            <!-- Errors ---------->
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
                            <!-- ./Errors ---------->

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
                                    {{--=========================================================--}}
                                    <div class="row">
                                        <div class="col-sm-12">


                                            <?php
                                            $input_value = $active;
                                            $input_name = 'active';
                                            $input_desc = __('global.active');
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


                                            <div class="col-sm-4">
                                                <?php
                                                $input_value = $sif;
                                                $input_name = 'sif';
                                                $input_desc = __('towers.sif');
                                                $input_desc_long = __('towers.sif_des');
                                                $input_maxlength = '20';
                                                $input_readonly = '';
                                                $input_css = ''; //text-red
                                                $input_mandatory = ''; //*
                                                $input_icon = '';
                                                ?>
                                                <div class="form-group">
                                                    <i class="fas {{$input_icon}} text-warning "></i>
                                                    <label for="{{$input_name}}"
                                                           class="{{$input_css}}" title="{{$input_desc_long}}" >{{$input_desc}}{{$input_mandatory}}</label>
                                                    <input type="text" id="{{$input_name}}" name="{{$input_name}}"
                                                           class="form-control" value="{{$input_value}}"
                                                           maxlength="{{$input_maxlength}}" {{$input_readonly}}  title="{{$input_desc_long}}" >
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <?php
                                                $input_value = $type;
                                                $input_name = 'type';
                                                $input_desc = __('towers.type');
                                                $input_desc_long = __('towers.type_des');
                                                $input_maxlength = '20';
                                                $input_readonly = '';
                                                $input_css = 'text-red'; //text-red
                                                $input_mandatory = '*'; //*
                                                $input_icon = '';
                                                ?>
                                                <div class="form-group">
                                                    <i class="fas {{$input_icon}} text-warning "></i>
                                                    <label for="{{$input_name}}"
                                                           class="{{$input_css}}"  title="{{$input_desc_long}}">{{$input_desc}}{{$input_mandatory}}</label>
                                                    <input type="text" id="{{$input_name}}" name="{{$input_name}}"
                                                           class="form-control" value="{{$input_value}}"
                                                           maxlength="{{$input_maxlength}}" {{$input_readonly}}  title="{{$input_desc_long}}">
                                                </div>
                                            </div>

                                        <div class="col-sm-2">
                                            <?php

                                            $input_value = $voltage;
                                            $input_name = 'voltage';
                                            $input_desc = __('towers.voltage');
                                            $input_desc_long = __('towers.voltage_des');
                                            $input_readonly = '';
                                            $input_css = 'text-red'; //text-red
                                            $input_mandatory = '*'; //*
                                            $input_icon = '';
                                            ?>
                                            <div class="form-group">
                                                <i class="fas {{$input_icon}} text-warning "></i>
                                                <label class="{{ $input_css }}"   title="{{$input_desc_long}}">{{ $input_desc }}{{$input_mandatory}}</label>
                                                <select class="select2bs4"
                                                        id="{{ $input_name }}" name="{{ $input_name }}"
                                                        autocomplete="off" {{ $input_readonly }}   title="{{$input_desc_long}}"  style="width: 100%">
                                                    @if (count($voltages) > 0)
                                                        <option value="">&nbsp;</option>
                                                        @foreach ($voltages as $voltage)
                                                            <option
                                                                value="{{ $voltage->title }}"
                                                                {{ (($input_value)==$voltage->title) ? 'selected' : '' }}>
                                                                {{ $voltage->title }}
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
                                            $input_value = $angle;
                                            $input_name = 'angle';
                                            $input_desc = __('towers.angle');
                                            $input_desc_long = __('towers.angle_des');
                                            $input_maxlength = '10';
                                            $input_readonly = '';
                                            $input_css = ''; //text-red
                                            $input_mandatory = ''; //*
                                            $input_icon = '';
                                            ?>
                                            <div class="form-group">
                                                <i class="fas {{$input_icon}} text-warning "></i>
                                                <label for="{{$input_name}}"
                                                       class="{{$input_css}}" title="{{$input_desc_long}}">{{$input_desc}}{{$input_mandatory}}</label>
                                                <input type="text" id="{{$input_name}}" name="{{$input_name}}"
                                                       class="form-control only-decimal" value="{{$input_value}}"
                                                       maxlength="{{$input_maxlength}}" {{$input_readonly}} title="{{$input_desc_long}}">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <?php
                                            $input_value = $mass;
                                            $input_name = 'mass';
                                            $input_desc = __('towers.mass');
                                            $input_desc_long = __('towers.mass_des');
                                            $input_maxlength = '10';
                                            $input_readonly = '';
                                            $input_css = ''; //text-red
                                            $input_mandatory = ''; //*
                                            $input_icon = '';
                                            ?>
                                            <div class="form-group">
                                                <i class="fas {{$input_icon}} text-warning "></i>
                                                <label for="{{$input_name}}"
                                                       class="{{$input_css}}" title="{{$input_desc_long}}">{{$input_desc}}{{$input_mandatory}}</label>
                                                <input type="text" id="{{$input_name}}" name="{{$input_name}}"
                                                       class="form-control only-decimal" value="{{$input_value}}"
                                                       maxlength="{{$input_maxlength}}" {{$input_readonly}} title="{{$input_desc_long}}">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <?php
                                            $input_value = $vid;
                                            $input_name = 'vid';
                                            $input_desc = __('towers.vid');
                                            $input_desc_long = __('towers.vid_des');
                                            $input_maxlength = '10';
                                            $input_readonly = '';
                                            $input_css = ''; //text-red
                                            $input_mandatory = ''; //*
                                            $input_icon = '';
                                            ?>
                                            <div class="form-group">
                                                <i class="fas {{$input_icon}} text-warning "></i>
                                                <label class="{{ $input_css }}"   title="{{$input_desc_long}}">{{ $input_desc }}{{$input_mandatory}}</label>
                                                <select class="select2bs4"
                                                        id="{{ $input_name }}" name="{{ $input_name }}"
                                                        autocomplete="off" {{ $input_readonly }}   title="{{$input_desc_long}}"  style="width: 100%">

                                                        <option value="">&nbsp;</option>

                                                            <option value="E" {{ (($input_value)=='E') ? 'selected' : '' }}> Е (Единечен)</option>
                                                            <option value="D" {{ (($input_value)=='D') ? 'selected' : '' }}> D (Двоен)</option>


                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{--=========================================================--}}
                                    <div class="row">


                                        <div class="col-sm-4">
                                            <?php
                                            $input_value = $vis;
                                            $input_name = 'vis';
                                            $input_desc = __('towers.vis');
                                            $input_desc_long = __('towers.vis_des');
                                            $input_maxlength = '10';
                                            $input_readonly = '';
                                            $input_css = ''; //text-red
                                            $input_mandatory = ''; //*
                                            $input_icon = '';
                                            ?>
                                            <div class="form-group">
                                                <i class="fas {{$input_icon}} text-warning "></i>
                                                <label for="{{$input_name}}"
                                                       class="{{$input_css}}" title="{{$input_desc_long}}">{{$input_desc}}{{$input_mandatory}}</label>
                                                <input type="text" id="{{$input_name}}" name="{{$input_name}}"
                                                       class="form-control only-decimal" value="{{$input_value}}"
                                                       maxlength="{{$input_maxlength}}" {{$input_readonly}} title="{{$input_desc_long}}">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <?php
                                            $input_value = $vig;
                                            $input_name = 'vig';
                                            $input_desc = __('towers.vig');
                                            $input_desc_long = __('towers.vig_des');
                                            $input_maxlength = '10';
                                            $input_readonly = '';
                                            $input_css = ''; //text-red
                                            $input_mandatory = ''; //*
                                            $input_icon = '';
                                            ?>
                                            <div class="form-group">
                                                <i class="fas {{$input_icon}} text-warning "></i>
                                                <label for="{{$input_name}}"
                                                       class="{{$input_css}}" title="{{$input_desc_long}}">{{$input_desc}}{{$input_mandatory}}</label>
                                                <input type="text" id="{{$input_name}}" name="{{$input_name}}"
                                                       class="form-control only-decimal" value="{{$input_value}}"
                                                       maxlength="{{$input_maxlength}}" {{$input_readonly}} title="{{$input_desc_long}}">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <?php
                                            $input_value = $mhr;
                                            $input_name = 'mhr';
                                            $input_desc = __('towers.mhr');
                                            $input_desc_long = __('towers.mhr_des');
                                            $input_maxlength = '10';
                                            $input_readonly = '';
                                            $input_css = ''; //text-red
                                            $input_mandatory = ''; //*
                                            $input_icon = '';
                                            ?>
                                            <div class="form-group">
                                                <i class="fas {{$input_icon}} text-warning "></i>
                                                <label for="{{$input_name}}"
                                                       class="{{$input_css}}"  title="{{$input_desc_long}}">{{$input_desc}}{{$input_mandatory}}</label>
                                                <input type="text" id="{{$input_name}}" name="{{$input_name}}"
                                                       class="form-control only-decimal" value="{{$input_value}}"
                                                       maxlength="{{$input_maxlength}}" {{$input_readonly}}  title="{{$input_desc_long}}">
                                            </div>
                                        </div>
                                    </div>
                                    {{--=========================================================--}}
                                    <div class="row">


                                        <div class="col-sm-4">
                                            <?php
                                            $input_value = $dkp;
                                            $input_name = 'dkp';
                                            $input_desc = __('towers.dkp');
                                            $input_desc_long = __('towers.dkp_des');
                                            $input_maxlength = '10';
                                            $input_readonly = '';
                                            $input_css = ''; //text-red
                                            $input_mandatory = ''; //*
                                            $input_icon = '';
                                            ?>
                                            <div class="form-group">
                                                <i class="fas {{$input_icon}} text-warning "></i>
                                                <label for="{{$input_name}}"
                                                       class="{{$input_css}}"  title="{{$input_desc_long}}">{{$input_desc}}{{$input_mandatory}}</label>
                                                <input type="text" id="{{$input_name}}" name="{{$input_name}}"
                                                       class="form-control" value="{{$input_value}}"
                                                       maxlength="{{$input_maxlength}}" {{$input_readonly}}  title="{{$input_desc_long}}">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <?php
                                            $input_value = $dkz;
                                            $input_name = 'dkz';
                                            $input_desc = __('towers.dkz');
                                            $input_desc_long = __('towers.dkz_des');
                                            $input_maxlength = '10';
                                            $input_readonly = '';
                                            $input_css = ''; //text-red
                                            $input_mandatory = ''; //*
                                            $input_icon = '';
                                            ?>
                                            <div class="form-group">
                                                <i class="fas {{$input_icon}} text-warning "></i>
                                                <label for="{{$input_name}}"
                                                       class="{{$input_css}}"  title="{{$input_desc_long}}">{{$input_desc}}{{$input_mandatory}}</label>
                                                <input type="text" id="{{$input_name}}" name="{{$input_name}}"
                                                       class="form-control only-decimal" value="{{$input_value}}"
                                                       maxlength="{{$input_maxlength}}" {{$input_readonly}}  title="{{$input_desc_long}}">
                                            </div>
                                        </div>


                                        </div>
                                    {{--=========================================================--}}
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <?php
                                            $input_value = $rap;
                                            $input_name = 'rap';
                                            $input_desc = __('towers.rap');
                                            $input_desc_long = __('towers.rap_des');
                                            $input_maxlength = '';
                                            $input_readonly = '';
                                            $input_css = ''; //text-red
                                            $input_mandatory = ''; //*
                                            $input_icon = '';
                                            ?>
                                            <div class="form-group">
                                                <i class="fas {{$input_icon}} text-warning "></i>
                                                <label class="{{ $input_css }}"   title="{{$input_desc_long}}">{{ $input_desc }}{{$input_mandatory}}</label>
                                                <select class="select2bs4"
                                                        id="{{ $input_name }}" name="{{ $input_name }}"
                                                        autocomplete="off" {{ $input_readonly }}   title="{{$input_desc_long}}"  style="width: 100%">

                                                    <option value="">&nbsp;</option>

                                                    <option value="H" {{ (($input_value)=='H') ? 'selected' : '' }}> H (Хоризонтален)</option>
                                                    <option value="V" {{ (($input_value)=='V') ? 'selected' : '' }}> V (Вертикален)</option>
                                                    <option value="K" {{ (($input_value)=='K') ? 'selected' : '' }}> K (Кос)</option>


                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <?php
                                            $input_value = $raz;
                                            $input_name = 'raz';
                                            $input_desc = __('towers.raz');
                                            $input_desc_long = __('towers.raz_des');
                                            $input_maxlength = '';
                                            $input_readonly = '';
                                            $input_css = ''; //text-red
                                            $input_mandatory = ''; //*
                                            $input_icon = '';
                                            ?>
                                            <div class="form-group">
                                                <i class="fas {{$input_icon}} text-warning "></i>
                                                <label class="{{ $input_css }}"   title="{{$input_desc_long}}">{{ $input_desc }}{{$input_mandatory}}</label>
                                                <select class="select2bs4"
                                                        id="{{ $input_name }}" name="{{ $input_name }}"
                                                        autocomplete="off" {{ $input_readonly }}   title="{{$input_desc_long}}"  style="width: 100%">

                                                    <option value="">&nbsp;</option>

                                                    <option value="H" {{ (($input_value)=='H') ? 'selected' : '' }}> H (Хоризонтален)</option>
                                                    <option value="V" {{ (($input_value)=='V') ? 'selected' : '' }}> V (Вертикален)</option>
                                                    <option value="K" {{ (($input_value)=='K') ? 'selected' : '' }}> K (Кос)</option>


                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{--=========================================================--}}
                                    @if($id)
                                        <div class="row">
                                            <div class="col-sm-3">
                                                    <?php
                                                    $input_value = $created_at;
                                                    $input_name = 'created_at';
                                                    $input_desc = __('global.created_at');
                                                    $input_maxlength = '';
                                                    $input_readonly = 'readonly';
                                                    $input_css = ''; //text-red
                                                    $input_mandatory = ''; //*
                                                    $input_icon = 'fa-clock';
                                                    ?>
                                                <div class="form-group">
                                                    <i class="fas {{$input_icon}} text-warning "></i>
                                                    <label for="{{$input_name}}"
                                                           class="{{$input_css}}">{{$input_desc}}{{$input_mandatory}}</label>
                                                    <input type="text" id="{{$input_name}}" name="{{$input_name}}"
                                                           class="form-control" value="{{$input_value}}"
                                                           maxlength="{{$input_maxlength}}" {{$input_readonly}}>
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                    <?php
                                                    $input_value = $updated_at;
                                                    $input_name = 'updated_at';
                                                    $input_desc = __('global.updated_at');
                                                    $input_maxlength = '';
                                                    $input_readonly = 'readonly';
                                                    $input_css = ''; //text-red
                                                    $input_mandatory = ''; //*
                                                    $input_icon = 'fa-clock';
                                                    ?>
                                                <div class="form-group">
                                                    <i class="fas {{$input_icon}} text-warning "></i>
                                                    <label for="{{$input_name}}"
                                                           class="{{$input_css}}">{{$input_desc}}{{$input_mandatory}}</label>
                                                    <input type="text" id="{{$input_name}}" name="{{$input_name}}"
                                                           class="form-control" value="{{$input_value}}"
                                                           maxlength="{{$input_maxlength}}" {{$input_readonly}}>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <i class="fas fa-user text-success "></i>
                                                    <b>{{__('global.created_by')}} </b>: {{$created_by}}<br>
                                                    <i class="fas fa-user text-danger "></i>
                                                    <b>{{__('global.updated_by')}} </b>: {{$updated_by}}
                                                </div>


                                            </div>
                                        </div>
                                    @endif
                                    {{--=========================================================--}}

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="button" onclick="form_edit.submit();"
                                            class="btn btn-success float-right">{{__('global.save')}}</button>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col-md-6 -->

                        <!--   Image ================================================================================-->
                        <div class="col-md-6">
                            <div class="card card">

                                <div class="card-header">
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                data-toggle="tooltip" title="Collapse">
                                            <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>

                                <div class="card-body">


                                    <div class="row">
                                        <div class="col-sm-12">

                                            <div class="form-group">
                                                <label>{!! __('towers.edit.image.attach')!!}</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="picture"
                                                               name="picture"
                                                               onchange="checkImage(this,'{!! __('towers.edit.image.title_res')!!}','{!! __('towers.edit.image.type')!!}','{!! __('towers.edit.image.size',['size'=>config('towers.allowed_image_size')])!!}','{!! config('towers.allowed_image_size')!!}','{!! __('towers.edit.image.save_warning')!!}','{!!$picture!!}')"

                                                               autocomplete="off">
                                                        <label class="custom-file-label" id="custom-file-label"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                                $css = empty($picture) ? 'display: none' : '';
                                                $src = !empty($picture) ? $path_upload . $id . '/' . $picture : '';
                                                $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443 ? "https://" : "http://";
                                                $domain = $protocol . $_SERVER['HTTP_HOST'];
                                            @endphp
                                            <input type="hidden" id="file_name_hidden" name="file_name_hidden"
                                                   value="{{$picture}}" autocomplete="off">
                                            <div class="form-group" id="picture_content" name="picture_content"
                                                 style="{{$css}}">

                                                <div class="time-label">
                                                    <img id="upload_image"
                                                         class="img-circle img-bordered-sm modal_image"
                                                         data-target="#ModalImage"
                                                         width="70px" height="70px" alt="image" data-toggle="modal"
                                                         src="{{asset($src)}}"
                                                         data-url="{{$domain}}/{{$path_upload}}{{$id}}/{{ $picture}}"
                                                         data-title="{{$picture}}"
                                                         title="{{ $picture}}"
                                                         style="cursor: pointer">
                                                    <a href="#" class="btn btn-outline-danger"
                                                       onclick="delPhoto('{!! __('towers.edit.image.delete_warning')!!}','{{$picture}}')"
                                                       title="{{__('towers.edit.image.detach')}}">
                                                        <i class="fa fa-file-archive"></i>
                                                    </a>
                                                    <div class="timeline-item" id="file_name_"
                                                         title="{{$picture}}">{{$picture}}</div>
                                                </div>
                                            </div>
                                            <div class="timeline-item text-red" id="warning_message"></div>

                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col-md-6 -->
                        <!--   End Image ================================================================================-->

                    </div>

                </form>
                <!-- /.form -->
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
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ url('LTE/plugins/toastr/toastr.min.css')}}">
@endsection

@section('additional_js')

    <!-- Select2 -->
    <script src="{{url('LTE/plugins/select2/js/select2.full.min.js')}}"></script>


    <script>
        ////////////////////////////////////////////////////////////////////////
        // Query the elements

        const passwordEle = document.getElementById('password');
        const passwordEle1 = document.getElementById('confirm-password');
        const toggleEle = document.getElementById('toggle');
        if (passwordEle && passwordEle1 && toggleEle) {
            toggleEle.addEventListener('click', function () {
                const type = passwordEle.getAttribute('type');
                passwordEle.setAttribute(
                    'type',
                    type === 'password' ? 'text' : 'password'
                );
                const type1 = passwordEle1.getAttribute('type');
                passwordEle1.setAttribute(
                    'type',
                    type1 === 'password' ? 'text' : 'password'
                );
            });
        }
        ////////////////////////////////////////////////////////////////////////

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        document.addEventListener("input", function (e) {
            if (e.target.classList.contains("only-decimal")) {

                let value = e.target.value;

                // 1) задржи само бројки и точки
                value = value.replace(/[^0-9.]/g, "");
                value = value.replace(/(\.\d{2}).+/g, '$1');

                // 2) дозволи само една точка
                let parts = value.split('.');
                if (parts.length > 2) {
                    value = parts[0] + '.' + parts.slice(1).join('');
                }

                e.target.value = value;
            }
        });

    </script>

@endsection
