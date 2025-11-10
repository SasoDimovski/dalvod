

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
    $url_update = url($url_base.'/update_endpoints/' . $id);
    $url_action = !empty($id) ? $url_update : $url_store;
    $url_return = url($url_base.'/edit/' . $id);

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


                            <!-- /.form -->
                            @if(count($trasa) > 0)
                                @foreach($trasa as $trasa_)
                                    <input type="hidden" name="trasa[{{ $trasa_->id }}][id]" value="{{ $trasa_->id }}">
                                    @if($trasa_->id_trafo)


                                        <div class="row">
                                            <div class="col-sm-3">{{__('projects.edit-endpoints.trafo')}} ({{ $trasa_->id }})</div>
                                        </div>

                                        {{--=========================================================--}}
                                        <div class="row">
                                            <div class="col-sm-3">
                                                    <?php
                                                    $input_value = $trasa_->trafo->ime ;
                                                    $input_name = "trafo[{$trasa_->id_trafo}][ime]";
                                                    $input_id   = "trafo{$trasa_->id_trafo}_ime";
                                                    $input_desc = __('projects.edit-endpoints.ime');
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
                                        </div>
                                        {{--=========================================================--}}
                                        <div class="row">
                                            <div class="col-sm-3">
                                                    <?php
                                                    $input_value = $trasa_->stac_t ;
                                                    $input_name = "trasa[{$trasa_->id}][stac_t]";
                                                    $input_id   = "trasa{$trasa_->id}_stac_t";
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
                                            <div class="col-sm-3">
                                                    <?php
                                                    $input_value = $trasa_->kota_t ;
                                                    $input_name = "trasa[{$trasa_->id}][kota_t]";
                                                    $input_id   = "trasa{$trasa_->id}_kota_t";
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
                                            <div class="col-sm-3">
                                                    <?php
                                                    $input_value = $trasa_->agol_tr ;
                                                    $input_name = "trasa[{$trasa_->id}][agol_tr]";
                                                    $input_id   = "trasa{$trasa_->id}_agol_tr";
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

                                        </div>
                                        {{--=========================================================--}}
                                        <div class="row">
                                            <div class="col-sm-3">
                                                    <?php
                                                    $input_value = $trasa_->trafo->visna_p ;
                                                    $input_name = "trafo[{$trasa_->id_trafo}][visna_p]";
                                                    $input_id   = "trafo{$trasa_->id_trafo}_visna_p";
                                                    $input_desc = __('projects.edit-endpoints.visna_p');
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

                                            <div class="col-sm-3">
                                                    <?php
                                                    $input_value = $trasa_->trafo->visina_zj ;
                                                    $input_name = "trafo[{$trasa_->id_trafo}][visina_zj]";
                                                    $input_id   = "trafo{$trasa_->id_trafo}_visina_zj";
                                                    $input_desc = __('projects.edit-endpoints.visina_zj');
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

                                            <div class="col-sm-3">
                                                    <?php
                                                    $input_value = $trasa_->trafo->hor_ras ;
                                                    $input_name = "trafo[{$trasa_->id_trafo}][hor_ras]";
                                                    $input_id   = "trafo{$trasa_->id_trafo}_hor_ras";
                                                    $input_desc = __('projects.edit-endpoints.hor_ras');
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
                                        </div>
                                        {{--=========================================================--}}
                                        <div class="row">
                                            <div class="col-sm-6">
                                                    <?php

                                                    $input_value = $trasa_->id_izolam1;
                                                    $input_name = "trasa[{$trasa_->id}][id_izolam1]";
                                                    $input_id   = "trasa{$trasa_->id}_id_izolam1";
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
                                                                    value="{{ $izolam_->id }}"
                                                                    {{ ($input_value==$izolam_->id) ? 'selected' : '' }}>
                                                                    {{ $izolam_->tip }} / {{ $izolam_->napon }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>

                                            </div>


                                        </div>
                                        {{--=========================================================--}}


                                    @else


                                        <div class="row"><div class="col-sm-3">{{__('projects.edit-endpoints.stolb')}} ({{ $trasa_->id }})</div>
                                        </div>
                                        {{--=========================================================--}}
                                        <div class="row">
                                            <div class="col-sm-3">
                                                    <?php
                                                    $input_value = $trasa_->stac_t ;
                                                    $input_name = "trasa[{$trasa_->id}][stac_t]";
                                                    $input_id   = "trasa{$trasa_->id}_stac_t";
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
                                            <div class="col-sm-3">
                                                    <?php
                                                    $input_value = $trasa_->kota_t ;
                                                    $input_name = "trasa[{$trasa_->id}][kota_t]";
                                                    $input_id   = "trasa{$trasa_->id}_kota_t";
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

                                        </div>
                                        {{--=========================================================--}}
                                        <div class="row">
                                            <div class="col-sm-6">
                                                    <?php

                                                    $input_value = $trasa_->id_stolb;
                                                    $input_name = "trasa[{$trasa_->id}][id_stolb]";
                                                    $input_id   = "trasa{$trasa_->id}_id_stolb";
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
                                                                    value="{{ $stolb_->id }}"
                                                                    {{ (($trasa_->id_stolb)==$stolb_->id) ? 'selected' : '' }}>
                                                                    {{ $stolb_->tip }}  / {{ $stolb_->nap }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>

                                            </div>


                                        </div>
                                        {{--=========================================================--}}
                                        <div class="row">
                                            <div class="col-sm-6">
                                                    <?php

                                                    $input_value = $trasa_->id_izolam1;
                                                    $input_name = "trasa[{$trasa_->id}][id_izolam1]";
                                                    $input_id   = "trasa{$trasa_->id}_id_izolam1";
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
                                                                    value="{{ $izolam_->id }}"
                                                                    {{ (($input_value)==$izolam_->id) ? 'selected' : '' }}>
                                                                    {{ $izolam_->tip }}/ {{ $izolam_->napon }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>

                                            </div>


                                        </div>
                                        {{--=========================================================--}}



                                    @endif


                                @endforeach
                            @endif


                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">

                                    <button type="submit" class="btn btn-submit  btn-success check-duration float-right">{{__('global.save')}}</button>
                                </div>
                            </div>


                        </form>





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


