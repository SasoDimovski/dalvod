
<div class="container-fluid">


    @if(!$gapres->isEmpty())

        <div class="row">
            <div class="col-sm-12  scrollmenu">

                <table id="example2" class="table_grid">
                    <thead>
                    <tr>
                        <th class="text-center">id</th>
                        <th class="text-center">id_project</th>
                        <th class="text-center">br_stolb</th>
                        <th class="text-center">stac_t</th>
                        <th class="text-center">raspon	</th>
                        <th class="text-center">grr_lpro</th>
                        <th class="text-center">grr_dpro</th>
                        <th class="text-center">grr_vpro</th>
                        <th class="text-center">proc_gv</th>
                        <th class="text-center">grr_st</th>
                        <th class="text-center">grr_lprk</th>
                        <th class="text-center">grr_dprk</th>
                        <th class="text-center">grr_vprk</th>
                        <th class="text-center">elr_pro1</th>
                        <th class="text-center">elr_pro2</th>
                        <th class="text-center">sre_ras</th>
                        <th class="text-center">proc_sr</th>
                        <th class="text-center">s_ra_st</th>
                        <th class="text-center">grr_lzaj</th>
                        <th class="text-center">grr_dzaj</th>
                        <th class="text-center">grr_vzaj</th>
                        <th class="text-center">proc_gz</th>
                        <th class="text-center">elr_zaj1</th>
                        <th class="text-center">elr_zaj2</th>
                        <th class="text-center">kota_pro</th>
                        <th class="text-center">kota_zaj</th>
                        <th class="text-center">ras_totp</th>
                        <th class="text-center">ras_totz</th>
                        <th class="text-center">agol_t</th>
                        <th class="text-center">stol_ag1</th>
                        <th class="text-center">br_ras</th>

                    </tr>
                    </thead>

                    <tbody>
                    @foreach($gapres as $gapres_)

                            <?php
                            $id        =$gapres_->id         ?? '';
                            $id_project=$gapres_->id_project ?? '';
                            $br_stolb  =$gapres_->br_stolb   ?? '';
                            $stac_t    =$gapres_->stac_t     ?? '';
                            $raspon    =$gapres_->raspon     ?? '';
                            $grr_lpro  =$gapres_->grr_lpro   ?? '';
                            $grr_dpro  =$gapres_->grr_dpro   ?? '';
                            $grr_vpro  =$gapres_->grr_vpro   ?? '';
                            $proc_gv   =$gapres_->proc_gv    ?? '';
                            $grr_st    =$gapres_->grr_st     ?? '';
                            $grr_lprk  =$gapres_->grr_lprk   ?? '';
                            $grr_dprk  =$gapres_->grr_dprk   ?? '';
                            $grr_vprk  =$gapres_->grr_vprk   ?? '';
                            $elr_pro1  =$gapres_->elr_pro1   ?? '';
                            $elr_pro2  =$gapres_->elr_pro2   ?? '';
                            $sre_ras   =$gapres_->sre_ras    ?? '';
                            $proc_sr   =$gapres_->proc_sr    ?? '';
                            $s_ra_st   =$gapres_->s_ra_st    ?? '';
                            $grr_lzaj  =$gapres_->grr_lzaj   ?? '';
                            $grr_dzaj  =$gapres_->grr_dzaj   ?? '';
                            $grr_vzaj  =$gapres_->grr_vzaj   ?? '';
                            $proc_gz   =$gapres_->proc_gz    ?? '';
                            $elr_zaj1  =$gapres_->elr_zaj1   ?? '';
                            $elr_zaj2  =$gapres_->elr_zaj2   ?? '';
                            $kota_pro  =$gapres_->kota_pro   ?? '';
                            $kota_zaj  =$gapres_->kota_zaj   ?? '';
                            $ras_totp  =$gapres_->ras_totp   ?? '';
                            $ras_totz  =$gapres_->ras_totz   ?? '';
                            $agol_t    =$gapres_->agol_t     ?? '';
                            $stol_ag1  =$gapres_->stol_ag1   ?? '';
                            $br_ras    =$gapres_->br_ras     ?? '';
                            ?>

                        <tr>
                            <td class="text-center">{{$id}}</td>
                            <td class="text-center">{{$id_project}}</td>
                            <td class="text-center">{{$br_stolb}}</td>
                            <td class="text-center">{{$stac_t}}</td>
                            <td class="text-center">{{$raspon	}}</td>
                            <td class="text-center">{{$grr_lpro}}</td>
                            <td class="text-center">{{$grr_dpro}}</td>
                            <td class="text-center">{{$grr_vpro}}</td>
                            <td class="text-center">{{$proc_gv}}</td>
                            <td class="text-center">{{$grr_st}}</td>
                            <td class="text-center">{{$grr_lprk}}</td>
                            <td class="text-center">{{$grr_dprk}}</td>
                            <td class="text-center">{{$grr_vprk}}</td>
                            <td class="text-center">{{$elr_pro1}}</td>
                            <td class="text-center">{{$elr_pro2}}</td>
                            <td class="text-center">{{$sre_ras}}</td>
                            <td class="text-center">{{$proc_sr}}</td>
                            <td class="text-center">{{$s_ra_st}}</td>
                            <td class="text-center">{{$grr_lzaj}}</td>
                            <td class="text-center">{{$grr_dzaj}}</td>
                            <td class="text-center">{{$grr_vzaj}}</td>
                            <td class="text-center">{{$proc_gz}}</td>
                            <td class="text-center">{{$elr_zaj1}}</td>
                            <td class="text-center">{{$elr_zaj2}}</td>
                            <td class="text-center">{{$kota_pro}}</td>
                            <td class="text-center">{{$kota_zaj}}</td>
                            <td class="text-center">{{$ras_totp}}</td>
                            <td class="text-center">{{$ras_totz}}</td>
                            <td class="text-center">{{$agol_t}}</td>
                            <td class="text-center">{{$stol_ag1}}</td>
                            <td class="text-center">{{$br_ras}}</td>


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


