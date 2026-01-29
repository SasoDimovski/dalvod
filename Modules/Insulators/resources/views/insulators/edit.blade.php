@extends('admin/master')
@section('content')

    <?php
    $id_module = $module->id ?? '';
    $lang = request()->segment(2);
    $query = request()->getQueryString();

    $id = $insulator->id ?? '';


    $sifra = $insulator->sifra ?? old('sifra');
    $type = $insulator->type ?? old('type');
    $voltage = $insulator->voltage ?? old('voltage');
    $length= $insulator->length ?? old('length');
    $mass = $insulator->mass ?? old('mass');
    $massd = $insulator->massd ?? old('massd');

    $insulator_material = $insulator->insulator_material ?? old('insulator_material');
    $number = $insulator->number ?? old('number');
    $breaking_load = $insulator->breaking_load ?? old('breaking_load');

    $id_insulator_chain = $insulator->id_insulator_chain ?? old('id_insulator_chain');
    $support_insulator= $insulator->support_insulator ?? old('support_insulator');
    $rap = $insulator->rap ?? old('rap');
    $raz= $insulator->raz ?? old('raz');
    $picture = $insulator->picture ?? old('picture');


    $active = $insulator->active ?? '';
    $deleted = $insulator->deleted ?? '';
    $created_at = (isset($insulator->created_at)) ? date("d.m.Y  H:i:s", strtotime($insulator->created_at)) : '';
    $updated_at = (isset($insulator->updated_at)) ? date("d.m.Y  H:i:s", strtotime($insulator->updated_at)) : '';
    $created_by = ($insulator->createdBy?->username . ', ' . $insulator->createdBy?->name . ' ' . $insulator->createdBy?->surname) ?: '';
    $updated_by = ($insulator->updatedBy?->username . ', ' . $insulator->updatedBy?->name . ' ' . $insulator->updatedBy?->surname) ?: '';

    $url = url('admin/' . $lang . '/' . $module->link);

    $url_store =  $url . '/store/';
    $url_update =  $url . '/update/'. $id;
    $url_action = !empty($id) ? $url_update : $url_store;
    $url_return =  $url . '/edit/' . $id;


    $path_upload = 'uploads/insulators/';

    $message_error = (isset($id)) ? __('global.update_error') : __('global.save_error');
    $message_success = (isset($id)) ? __('global.update_success') : __('global.save_success');

    ?>


        <!-- Content Wrapper. Contains plengthe content -->
    <div class="content-wrapper">

        <!-- Content Header (Plengthe header) -->
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
        <!-- / Content Header (Plengthe header) -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @include('admin._flash-message')

                <!-- Form-->
                <form class="needs-validation" role="form" id="form_edit" name="form_edit"
                      action="{{ "{$url_action}" }}" method="POST" enctype="multypeart/form-data"  autocomplete="off">
                    <input type="hidden" id="url_return" name="url_return" value="{{ $url_return }}">
                    <input type="hidden" id="query" name="query" value="{{$query}}">
                    <input type="hidden" id="message_error" name="message_error" value="{{ $message_error }}">
                    <input type="hidden" id="message_success" name="message_success" value="{{ $message_success }}">

                    <input type="hidden" id="id" name="id" value="{{ $id}}">
                    <input type="hidden" id="id_module" name="id_module" value="{{ $id_module}}">
                    {{csrf_field()}}
                    @method('PUT')

                    <div class="row">


                        <div class="col-sm-12 col-md-12  col-lg-12 col-xl-6">

                            <!-- Errors ---------->
                            @if (count($errors) > 0)
                                <div id="toast-container" class="toast-top-full-width" onclick="closeErrorWindow(this)"
                                     style="width:100%" ;>

                                    <div class="toast toast-error" aria-live="assertive" style="width:100%" ;>
                                        <div class="toast-progress" style="width:100%;"></div>
                                        <button type="button" class="close" data-dismiss="toast-top-full-width"
                                                role="button" onclick="closeErrorWindow(this)">×
                                        </button>
                                        <p><strong>{{__('global.error_not')}}</strong></p>
                                        <div class="toast-messlengthe">
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
                                                $input_value = $sifra;
                                                $input_name = 'sifra';
                                                $input_desc = __('insulators.sifra');
                                                $input_desc_long = __('insulators.sifra_des');
                                                $input_maxlength = '20';
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
                                                           class="form-control" value="{{$input_value}}"
                                                           maxlength="{{$input_maxlength}}" {{$input_readonly}} title="{{$input_desc_long}}">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <?php
                                                $input_value = $type;
                                                $input_name = 'type';
                                                $input_desc = __('insulators.type');
                                                $input_desc_long = __('insulators.type_des');
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
                                                           maxlength="{{$input_maxlength}}" {{$input_readonly}} title="{{$input_desc_long}}">
                                                </div>
                                            </div>

                                        <div class="col-sm-2">
                                            <?php

                                            $input_value = $voltage;
                                            $input_name = 'voltage';
                                            $input_desc = __('insulators.voltage');
                                            $input_desc_long = __('insulators.voltage_des');
                                            $input_readonly = '';
                                            $input_css = 'text-red'; //text-red
                                            $input_mandatory = '*'; //*
                                            $input_icon = '';
                                            ?>
                                            <div class="form-group">
                                                <i class="fas {{$input_icon}} text-warning "></i>
                                                <label class="{{ $input_css }}" title="{{$input_desc_long}}">{{ $input_desc }}{{$input_mandatory}}</label>
                                                <select class="select2bs4"
                                                        id="{{ $input_name }}" name="{{ $input_name }}"
                                                        autocomplete="off" {{ $input_readonly }} title="{{$input_desc_long}}"
                                                style="width: 100%">
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
                                            $input_value = $length;
                                            $input_name = 'length';
                                            $input_desc = __('insulators.length');
                                            $input_desc_long = __('insulators.length_des');
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
                                            $input_desc = __('insulators.mass');
                                            $input_desc_long = __('insulators.mass_des');
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
                                                       class="form-control  only-decimal" value="{{$input_value}}"
                                                       maxlength="{{$input_maxlength}}" {{$input_readonly}} title="{{$input_desc_long}}">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <?php
                                            $input_value = $massd;
                                            $input_name = 'massd';
                                            $input_desc = __('insulators.massd');
                                            $input_desc_long = __('insulators.massd_des');
                                            $input_maxlength = '10';
                                            $input_readonly = 'readonly';
                                            $input_css = ''; //text-red
                                            $input_mandatory = ''; //*
                                            $input_icon = '';
                                            ?>
                                            <div class="form-group">
                                                <i class="fas {{$input_icon}} text-warning "></i>
                                                <label for="{{$input_name}}"
                                                       class="{{$input_css}}" title="{{$input_desc_long}}">{{$input_desc}}{{$input_mandatory}}</label>
                                                <input type="text" id="{{$input_name}}" name="{{$input_name}}"
                                                       class="form-control  only-decimal" value="{{$input_value}}"
                                                       maxlength="{{$input_maxlength}}" {{$input_readonly}} title="{{$input_desc_long}}">

                                            </div>
                                        </div>

{{--                                        <div class="col-sm-4">--}}
{{--                                            <?php--}}
{{--                                            $input_value = $insulator_material;--}}
{{--                                            $input_name = 'insulator_material';--}}
{{--                                            $input_desc = __('insulators.insulator_material');--}}
{{--                                            $input_maxlength = '';--}}
{{--                                            $input_readonly = '';--}}
{{--                                            $input_css = 'text-red'; //text-red--}}
{{--                                            $input_mandatory = '*'; //*--}}
{{--                                            $input_icon = '';--}}
{{--                                            ?>--}}
{{--                                            <div class="form-group">--}}
{{--                                                <i class="fas {{$input_icon}} text-warning "></i>--}}
{{--                                                <label for="{{$input_name}}"--}}
{{--                                                       class="{{$input_css}}">{{$input_desc}}{{$input_mandatory}}</label>--}}
{{--                                                <input type="text" id="{{$input_name}}" name="{{$input_name}}"--}}
{{--                                                       class="form-control" value="{{$input_value}}"--}}
{{--                                                       maxlength="{{$input_maxlength}}" {{$input_readonly}}>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <div class="col-sm-2">
                                            <?php
                                            $input_value = $number;
                                            $input_name = 'number';
                                            $input_desc = __('insulators.number');
                                            $input_desc_long = __('insulators.number_des');
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

                                                    @for($i = 1; $i <= 24; $i++)
                                                        <option value="{{ $i }}" {{ ($input_value == $i) ? 'selected' : '' }}>
                                                            {{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <?php
                                            $input_value = $breaking_load;
                                            $input_name = 'breaking_load';
                                            $input_desc = __('insulators.breaking_load');
                                            $input_desc_long = __('insulators.breaking_load_des');
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
                                                    <option value="1.25" {{ (($input_value)=='1.25') ? 'selected' : '' }}>1.25</option>
                                                    <option value="80" {{ (($input_value)=='80') ? 'selected' : '' }}>80</option>
                                                    <option value="120" {{ (($input_value)=='120') ? 'selected' : '' }}>120</option>
                                                    <option value="160" {{ (($input_value)=='160') ? 'selected' : '' }}>160</option>
                                                    <option value="320" {{ (($input_value)=='320') ? 'selected' : '' }}>320</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{--=========================================================--}}
                                    <div class="row">


                                        <div class="col-sm-4">
                                            <?php

                                            $input_value = $id_insulator_chain;
                                            $input_name = 'id_insulator_chain';
                                            $input_desc = __('insulators.id_insulator_chain');
                                            $input_desc_long = __('insulators.id_insulator_chain_des');
                                            $input_readonly = '';
                                            $input_css = 'text-red'; //text-red
                                            $input_mandatory = '*'; //*
                                            $input_icon = '';
                                            ?>
                                            <div class="form-group">
                                                <i class="fas {{$input_icon}} text-warning "></i>
                                                <label class="{{ $input_css }}" title="{{$input_desc_long}}">{{ $input_desc }}{{$input_mandatory}}</label>
                                                <select class="select2bs4"
                                                        id="{{ $input_name }}" name="{{ $input_name }}"
                                                        autocomplete="off" {{ $input_readonly }} title="{{$input_desc_long}}">
                                                    @if (count($voltages) > 0)
                                                        <option value="">&nbsp;</option>
                                                        @foreach ($insulator_chain as $insulator_chain_)
                                                            <option
                                                                value="{{ $insulator_chain_->id }}"
                                                                {{ (($input_value)==$insulator_chain_->id) ? 'selected' : '' }}>
                                                                {{ $insulator_chain_->title }}
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
                                            $input_value = $support_insulator;
                                            $input_name = 'support_insulator';
                                            $input_desc = __('insulators.support_insulator');
                                            $input_readonly = '';
                                            $input_css = 'text';
                                            ?>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox"
                                                           id="{{$input_name}}"
                                                           name="{{$input_name}}"
                                                           value="1" @if($input_value==1) {{'checked'}} @endif {{$input_readonly}}>
                                                    <label class="custom-control-label" for="{{$input_name}}"
                                                           {{$input_css}} id="{{$input_name}}">{{$input_desc}}</label>
                                                </div>
                                            </div>


                                        </div>




                                        </div>
                                        {{--=========================================================--}}
                                        <div class="row">
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
                                                data-toggle="tooltype" title="Collapse">
                                            <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>

                                <div class="card-body">


                                    <div class="row">
                                        <div class="col-sm-12">

                                            <div class="form-group">
                                                <label>{!! __('insulators.edit.image.attach')!!}</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="picture"
                                                               name="picture"
                                                               onchange="checkImage(this,'{!! __('insulators.edit.image.title_res')!!}','{!! __('insulators.edit.image.type')!!}','{!! __('insulators.edit.image.size',['size'=>config('insulators.allowed_image_size')])!!}','{!! config('insulators.allowed_image_size')!!}','{!! __('insulators.edit.image.save_warning')!!}','{!!$picture!!}')"

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
                                                       onclick="delPhoto('{!! __('insulators.edit.image.delete_warning')!!}','{{$picture}}')"
                                                       title="{{__('insulators.edit.image.detach')}}">
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
    <!-- /.Content Wrapper. Contains plengthe content -->
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

    <style>
        .daterangepicker.single .drp-buttons {
            display: block !important;
        }
    </style>
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
