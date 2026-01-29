

    <div class="container-fluid">





        @if(!$raspres->isEmpty())

            <div class="row">
                <div class="col-sm-12  scrollmenu">

                    <table id="example2" class="table_grid">
                        <thead>
                        <tr><th class="text-center" style="white-space: nowrap; width: 1px;"></th>
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
                            <?php
                            $n=0;
                                ?>
                        @foreach($raspres as $raspres_)

                                <?php
                                    $n=$n+1;
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
                                <td class="text-center">{{$n}}</td>
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


