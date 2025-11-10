

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
    $url_action = url($url_base.'/store-point/'. $id);

    $url_return = url($url_base.'/edit_points/'. $id);
    $url_delete = url($url_base.'/delete-point/');
    $query = '';

    $path_upload = 'uploads/projects/';

    $message_error = (isset($id)) ? __('global.update_error') : __('global.save_error');
    $message_success = (isset($id)) ? __('global.update_success') : __('global.save_success');



/*   // $id_trasa = $trasa->id ?? '';
    $id_stac_t = $trasa->stac_t ?? 'stac_t';
    $id_kota_t = $trasa->kota_t ?? 'kota_t';
    $id_agol_tr = $trasa->agol_tr ?? 'agol_tr';
    $id_stolb = $trasa->id_stolb ?? 'id_stolb';
    $id_trafo = $trasa->id_trafo ?? 'id_trafo';
    $id_izolator1 = $trasa->id_izolator1 ?? 'id_izolator1';
    $id_izolator2= $trasa->id_izolator2 ?? 'id_izolator2';*/

    ?>




            <div class="container-fluid">

                <form class="needs-validation" role="form" id="form_edit" name="form_edit" action="{{$url_action}}" method="POST" enctype="multipart/form-data">

                    <input type="hidden" id="id" name="id" value="{{$id}}">
                    <input type="hidden" id="url_return" name="url_return" value="{{$url_return}}">
                    <input type="hidden" id="container" name="container" value="edit-points-container">


                    {{csrf_field()}}
                    @method('POST')
                    {{--=========================================================--}}
                    <div class="row">
                        <div class="col-sm-1">
                            <?php
                            $input_value = '';
                            $input_name = 'stac_t';
                            $input_id   = 'stac_t';
                            $input_desc = __('projects.edit-endpoints.stac_t');
                            $input_maxlength = 100;
                            $input_readonly = '';
                            $input_css = 'text-red';
                            $input_style = 'width: 80%;';
                            ?>
                            <div class="form-group">
                                <label for="{{$input_id}}" class="{{$input_css}}">{{$input_desc}}
                                    *</label>
                                <input type="text" id="{{$input_id}}" name="{{$input_name}}" style="{{$input_style}}"
                                       class="form-control" value="{{$input_value}}"
                                       maxlength="{{$input_maxlength}}" {{$input_readonly}}>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <?php
                            $input_value = '' ;
                            $input_name = 'kota_t';
                            $input_id   = 'kota_t';
                            $input_desc = __('projects.edit-endpoints.kota_t');
                            $input_maxlength = 100;
                            $input_readonly = '';
                            $input_css = 'text-red';
                            $input_style = 'width: 80%;';
                            ?>
                            <div class="form-group">
                                <label for="{{$input_id}}" class="{{$input_css}}">{{$input_desc}}
                                    *</label>
                                <input type="text" id="{{$input_id}}" name="{{$input_name}}" style="{{$input_style}}"
                                       class="form-control" value="{{$input_value}}"
                                       maxlength="{{$input_maxlength}}" {{$input_readonly}}>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <?php
                            $input_value = '' ;
                            $input_name = "agol_tr";
                            $input_id   = "agol_tr";
                            $input_desc = __('projects.edit-endpoints.agol_tr');
                            $input_maxlength = 100;
                            $input_readonly = '';
                            $input_css = 'text-red';
                            $input_style = 'width: 80%;';
                            ?>
                            <div class="form-group">
                                <label for="{{$input_id}}" class="{{$input_css}}">{{$input_desc}}
                                    *</label>
                                <input type="text" id="{{$input_id}}" name="{{$input_name}}" style="{{$input_style}}"
                                       class="form-control" value="{{$input_value}}"
                                       maxlength="{{$input_maxlength}}" {{$input_readonly}}>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <?php

                            $input_value = '';
                            $input_name = "id_stolb";
                            $input_id   = "id_stolb";
                            $input_desc = __('projects.edit-endpoints.stolb_tip');
                            $input_readonly = '';
                            $input_css = 'text-red';

                            ?>
                            <div class="form-group">
                                <label class="{{ $input_css }}">{{ $input_desc }} *</label>
                                <select class="select2bs4"
                                        id="{{ $input_id }}" name="{{ $input_name }}"
                                        autocomplete="off" {{ $input_readonly }}>
                                    @if (count($stolb) > 0)
                                        <option value="">&nbsp;</option>
                                        @foreach ($stolb as $stolb_)
                                            <option
                                                value="{{ $stolb_->id }}">
                                                {{ $stolb_->tip }} / {{ $stolb_->nap }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                        </div>

                        <div class="col-sm-2">
                            <?php

                            $input_value = '';
                            $input_name = "id_izolam1";
                            $input_id   = "id_izolam1";
                            $input_desc = __('projects.edit-endpoints.id_izolam1');
                            $input_readonly = '';
                            $input_css = 'text-red';

                            ?>
                            <div class="form-group">
                                <label class="{{ $input_css }}">{{ $input_desc }} *</label>
                                <select class="select2bs4"
                                        id="{{ $input_id }}" name="{{ $input_name }}"
                                        autocomplete="off" {{ $input_readonly }}>
                                    @if (count($izolam) > 0)
                                        <option value="">&nbsp;</option>
                                        @foreach ($izolam as $izolam_)
                                            <option
                                                value="{{ $izolam_->id }}">
                                                {{ $izolam_->tip }}/ {{ $izolam_->napon }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                        </div>


                        <div class="col-sm-2">
                            <?php

                            $input_value = '';
                            $input_name = "id_izolam2";
                            $input_id   = "id_izolam2";
                            $input_desc = __('projects.edit-endpoints.id_izolam1');
                            $input_readonly = '';
                            $input_css = 'text-red';

                            ?>
                            <div class="form-group">
                                <label class="{{ $input_css }}">{{ $input_desc }} *</label>
                                <select class="select2bs4"
                                        id="{{ $input_id }}" name="{{ $input_name }}"
                                        autocomplete="off" {{ $input_readonly }}>
                                    @if (count($izolam) > 0)
                                        <option value="">&nbsp;</option>
                                        @foreach ($izolam as $izolam_)
                                            <option
                                                value="{{ $izolam_->id }}">
                                                {{ $izolam_->tip }}/ {{ $izolam_->napon }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                        </div>

                        <div class="col-sm-2 d-flex justify-content-end align-items-end">
                            <button type="submit"
                                    class="btn btn-submit ajax btn-success float-right mb-3">{{__('projects.edit-points.add_stolb')}}</button>
                        </div>



            </div>
                    {{--=========================================================--}}

                    </form>



                @if(!$trasa->isEmpty())

                    <div class="row">
                        <div class="col-sm-12  scrollmenu">

                            <table id="example2" class="table_grid">
                                <thead>
                                <tr>
                                    <th class="text-center" style="white-space: nowrap; width: 1px;">{{__('projects.edit-points.id')}}</th>
                                    <th class="text-center" style="white-space: nowrap; width: 1px;">{{__('projects.edit-points.stacionaza')}}</th>
                                    <th class="text-center">{{__('projects.edit-points.kota')}}</th>
                                    <th class="text-center" style="white-space: nowrap; width: 1px;">{{__('projects.edit-points.agol')}}</th>
                                    <th class="text-center">{{__('projects.edit-points.stolb')}}</th>
                                    <th class="text-center">{{__('projects.edit-points.trafo')}}</th>
                                    <th class="text-center">{{__('projects.edit-points.izolam1')}}</th>
                                    <th class="text-center">{{__('projects.edit-points.izolam2')}}</th>
                                    <th class="text-center"></th>

                                </tr>
                                </thead>


                                <tbody>

                                @foreach($trasa as $trasa_)

                                        <?php


                                        $id = $trasa_->id ?? '';
                                        $stac_t = $trasa_->stac_t ?? '';
                                        $kota_t = $trasa_->kota_t ?? '';
                                        $agol_tr= $trasa_->agol_tr ?? '';

                                        $id_stolb = $trasa_->stolb->id_stolb?? '';
                                        $stolb_tip= $trasa_->stolb->tip?? '';


                                        $id_trafo= $trasa_->id_trafo ?? '';
                                        $ime= $trasa_->trafo->ime ?? '';

                                        $id_izolam1 = $trasa_->izolam1->id_izolam1?? '';
                                        $izolam1_tip = $trasa_->izolam1->tip?? '';
                                        $izolam1_napon = $trasa_->izolam1->napon?? '';

                                        $id_izolam2 = $trasa_->izolam2->id_izolam2?? '';
                                        $izolam2_tip = $trasa_->izolam2->tip?? '';
                                        $izolam2_napon = $trasa_->izolam2->napon?? '';
                                        ?>

                                    <tr @if(in_array($id, $firstTwoIds)) style="background-color:#ffe187 " @endif>
                                        <td class="text-center">{{$id}}</td>
                                        <td class="text-center">{{$stac_t}}</td>
                                        <td class="text-center">{{$kota_t}}</td>
                                        <td class="text-center">{{$agol_tr}}</td>
                                        <td class="text-center">{{$stolb_tip}}</td>
                                        <td class="text-center">{{$ime}}</td>
                                        <td class="text-center">{{$izolam1_tip}} / {{$izolam1_napon}}</td>
                                        <td class="text-center">{{$izolam2_tip}} / {{$izolam2_napon}}</td>
                                        <td class="text-center">

                                            <div class="btn-group btn-group-sm">
                                                {{-------------------------------------------------------------------------------------------------------}}
                                                {{--                                                            <button class="btn btn-info"--}}
                                                {{--                                                                    onclick="getContentID('{{$url_show.'/'. $project->id }}','ModalShow','{{ $module->title}}')">--}}
                                                {{--                                                                <i class="fas fa-eye"--}}
                                                {{--                                                                   title="{{__('global.show_hint')}}"></i></button>--}}
                                                {{-------------------------------------------------------------------------------------------------------}}
                          {{--                      <a href="{{$url_edit_points.'/'.$project->id.'?'.$query }}"
                                                   class="btn btn-primary"><i
                                                        class="fa fa-edit"
                                                        title="{{__('global.edit_hint')}}"></i></a>--}}
                                                {{-------------------------------------------------------------------------------------------------------}}
                           {{--                     <a href="{{$url_edit.'/'.$project->id.'?'.$query }}"
                                                   class="btn btn-success"><i
                                                        class="fa fa-edit"
                                                        title="{{__('global.edit_hint')}}"></i></a>--}}
                                                {{-------------------------------------------------------------------------------------------------------}}
                                                @if(!in_array($id, $firstTwoIds))
                                                <a href="#" class="btn btn-danger modal_warning"
                                                   data-toggle="modal"
                                                   data-target="#ModalWarning"

                                                   data-title="{{__('global.delete_record')}}"
                                                   data-url="{{$url_delete.'/'.$id.'?'.$query }}"

                                                   data-content_l="id: {{$id}}, "
                                                   data-content_b="{{ $stac_t}}, "
                                                   data-content_sub_l="{{ $kota_t}}"
                                                   data-content_sub_b=""

                                                   data-query="{{$query}}"
                                                   data-url_return="{{$url_return}}"
                                                   data-success="{{__('global.delete_success')}}"
                                                   data-error="{{__('global.delete_error')}}"

                                                   data-method="DELETE"

                                                   title="{{__('global.delete_hint')}}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                {{-------------------------------------------------------------------------------------------------------}}
                                                @endif

                                            </div>

                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>


                            </table>
                        </div>
                    </div>


                @else
                    {{__('global.no_records')}}
                @endif





                </div>












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


