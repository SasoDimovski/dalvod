<?php
$id_module = $module->id ?? '';
$lang = request()->segment(2);
$query = request()->getQueryString();

$id = $tower->id ?? '';


$picture = $tower->picture ?? '';
$active = $tower->active ?? '';
$deleted = $tower->deleted ?? '';
$created_at = (isset($tower->created_at)) ? date("d.m.Y  H:i:s", strtotime($tower->created_at)) : '';
$updated_at = (isset($tower->updated_at)) ? date("d.m.Y  H:i:s", strtotime($tower->updated_at)) : '';
$created_by = $tower->createdBy->username ?? '';
$updated_by = $tower->updatedBy->username ?? '';

$path_upload = 'uploads/towers/';

?>
<div class="col-12">
    <div class="row invoice-info">
        <div class="col-sm-12 invoice-col" >
            <div class="timeline">
                <!-- timeline time label -->

                <!--   ================================================================================-->
                <div class="time-label">
                    @if($active==0)
                        <span class="bg-gradient-red">{{ __('global.deactivated') }}</span>
                    @else
                        <span class="bg-gradient-success">{{ __('global.active') }}</span>
                    @endif

                    <br>
                    <span class="bg-gradient-gray" style="margin-top: 3px">  <i class="fas fa-circle text-warning"></i> <strong>{{__('global.id')}}</strong>: {{ $id }}</span>
                    <span class="bg-gradient-gray" style="margin-top: 3px"><i class="fas fa-clock text-warning"></i> <strong>{{__('global.created_at')}}</strong>: {{ $created_at}}</span>
                    <span class="bg-gradient-gray" style="margin-top: 3px"> <i class="fas fa-clock text-warning "></i> <strong> {{__('global.updated_at')}}</strong>: {{ $updated_at }}</span>
                </div>
                <!--   ================================================================================-->
                <div>
                    <i class="fas fa-list bg-info"></i>
                    <div class="timeline-item">
                        <div class="timeline-header">
                            <strong>{{__('towers.sif')}}</strong>: {{$tower->sif ?? ''}}
                            <hr>
                            <strong>{{__('towers.type')}}</strong>: {{$tower->type ?? ''}}
                            <hr>
                            <strong>{{__('towers.voltage')}}</strong>: {{$tower->voltage ?? ''}}
                            <hr>
                            <strong>{{__('towers.ag')}}</strong>: {{$tower->ag ?? ''}}
                            <hr>
                            <strong>{{__('towers.mass')}}</strong>: {{$tower->mass ?? ''}}
                            <hr>
                            <strong>{{__('towers.vid')}}</strong>: {{$tower->vid ?? ''}}
                            <hr>
                            <strong>{{__('towers.vis')}}</strong>: {{$tower->vis ?? ''}}
                            <hr>
                            <strong>{{__('towers.vig')}}</strong>: {{$tower->vig ?? ''}}
                            <hr>
                            <strong>{{__('towers.mhr')}}</strong>: {{$tower->mhr ?? ''}}
                            <hr>
                            <strong>{{__('towers.dkp')}}</strong>: {{$tower->dkp ?? ''}}
                            <hr>
                            <strong>{{__('towers.dkz')}}</strong>: {{$tower->dkz ?? ''}}
                            <hr>
                            <strong>{{__('towers.rap')}}</strong>: {{$tower->rap ?? ''}}
                            <hr>
                            <strong>{{__('towers.raz')}}</strong>: {{$tower->raz ?? ''}}
                            <hr>
                        </div>
                    </div>
                </div>
                <!--   ================================================================================-->
                <div>
                    <i class="fas fa-users bg-gradient-red"></i>
                    <div class="timeline-item">
                        <div class="timeline-header">
                            <i class="fas fa-user  text-warning"></i> <strong>{{__('global.created_by')}}</strong>: <b class="text-danger">{{$created_by}}</b>, <span class="text-danger">{{$tower->createdBy->name ?? ''}} {{$tower->createdBy->surname ?? ''}}</span><br>
                            <i class="fas fa-user  text-warning"></i> <strong>{{__('global.updated_by')}}</strong>: <b class="text-danger">{{$updated_by}}</b>,  <span class="text-danger">{{$tower->updatedBy->name ?? ''}} {{$tower->updatedBy->surname ?? ''}}</span>


                        </div>
                    </div>
                </div>
                <!--   ================================================================================-->
                @if(!empty($picture))
                    @php
                        $css = empty($picture) ? 'display: none' : '';
                        $src = !empty($picture) ? $path_upload . $id . '/' . $picture : '';
                        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443 ? "https://" : "http://";
                        $domain = $protocol . $_SERVER['HTTP_HOST'];
                    @endphp
                    <div class="time-label">
                        <img id="upload_image" class="img-circle img-bordered-sm modal_image"
                             data-target="#ModalImage"
                             width="70px" height="70px" alt="image" data-toggle="modal"
                             src="{{asset($src)}}"
                             data-url="{{$domain}}/{{$path_upload}}{{$id}}/{{ $picture}}"
                             data-title="{{$picture}}"
                             title="{{ $picture}}"
                             style="cursor: pointer">
                        <strong>{{$picture}}</strong>

                    </div>

                @endif
                <!--   ================================================================================-->

            </div>
        </div>
    </div>
</div>




