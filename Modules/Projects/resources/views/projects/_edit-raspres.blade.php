

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



/*   // $id_trasa = $raspres->id ?? '';
    $id_stac_t = $raspres->stac_t ?? 'stac_t';
    $id_kota_t = $raspres->kota_t ?? 'kota_t';
    $id_agol_tr = $raspres->agol_tr ?? 'agol_tr';
    $id_stolb = $raspres->id_stolb ?? 'id_stolb';
    $id_trafo = $raspres->id_trafo ?? 'id_trafo';
    $id_izolator1 = $raspres->id_izolator1 ?? 'id_izolator1';
    $id_izolator2= $raspres->id_izolator2 ?? 'id_izolator2';*/

    ?>




            <div class="container-fluid">





                @if(!$raspres->isEmpty())

                    <div class="row">
                        <div class="col-sm-12  scrollmenu">

                            <table id="example2" class="table_grid">
                                <thead>
                                <tr>
                                    <th class="text-center" style="white-space: nowrap; width: 1px;">id</th>
                                    <th class="text-center" style="white-space: nowrap; width: 1px;">id_project</th>
                                    <th class="text-center">stac_t</th>
                                    <th class="text-center" style="white-space: nowrap; width: 1px;">kota_t</th>
                                    <th class="text-center">raspon</th>
                                    <th class="text-center">vr_pro</th>
                                    <th class="text-center">vr_zaj </th>
                                    <th class="text-center">kota_pro</th>
                                    <th class="text-center">kota_zaj</th>
                                    <th class="text-center">ras_totp</th>
                                    <th class="text-center">ras_t2op</th>
                                    <th class="text-center">ras_totz</th>
                                    <th class="text-center">ras_t2oz</th>
                                    <th class="text-center">dol_pro</th>
                                    <th class="text-center">dol_zaj</th>

                                </tr>
                                </thead>

                                <tbody>
                                @foreach($raspres as $raspres_)

                                        <?php
                                        $id = $raspres_->id ?? '';
                                        $id_project= $raspres_->id_project ?? '';
                                        $stac_t = $raspres_->stac_t ?? '';
                                        $kota_t = $raspres_->kota_t ?? '';
                                        $raspon= $raspres_->raspon ?? '';
                                        $vr_pro= $raspres_->vr_pro?? '';
                                        $vr_zaj= $raspres_->vr_zaj?? '';
                                        $kota_pro= $raspres_->kota_pro ?? '';
                                        $kota_zaj= $raspres_->kota_zaj?? '';
                                        $ras_totp = $raspres_->ras_totp?? '';
                                        $ras_t2op = $raspres_->ras_t2op?? '';
                                        $ras_totz = $raspres_->ras_totz?? '';
                                        $ras_t2oz = $raspres_->ras_t2oz?? '';
                                        $dol_pro= $raspres_->dol_pro?? '';
                                        $dol_zaj = $raspres_->dol_zaj?? '';
                                        ?>

                                    <tr>
                                        <td class="text-center">{{$id}}</td>
                                        <td class="text-center">{{$id_project}}</td>
                                        <td class="text-center">{{$stac_t}}</td>
                                        <td class="text-center">{{$kota_t}}</td>
                                        <td class="text-center">{{$raspon}}</td>
                                        <td class="text-center">{{$vr_pro}}</td>
                                        <td class="text-center">{{$vr_zaj}}</td>
                                        <td class="text-center">{{$kota_pro}}</td>
                                        <td class="text-center">{{$kota_zaj}}</td>
                                        <td class="text-center">{{$ras_totp}}</td>
                                        <td class="text-center">{{$ras_t2op}}</td>
                                        <td class="text-center">{{$ras_totz}}</td>
                                        <td class="text-center">{{$ras_t2oz}}</td>
                                        <td class="text-center">{{$dol_pro}}</td>
                                        <td class="text-center">{{$dol_zaj}}</td>


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


