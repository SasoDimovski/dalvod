<?php
$id_module = $module->id ?? '';
$lang = request()->segment(2);
$query = request()->getQueryString();

$id = $conductor->id ?? '';


$picture = $conductor->picture ?? '';
$active = $conductor->active ?? '';
$deleted = $conductor->deleted ?? '';
$created_at = (isset($conductor->created_at)) ? date("d.m.Y  H:i:s", strtotime($conductor->created_at)) : '';
$updated_at = (isset($conductor->updated_at)) ? date("d.m.Y  H:i:s", strtotime($conductor->updated_at)) : '';
$created_by = $conductor->createdBy->username ?? '';
$updated_by = $conductor->updatedBy->username ?? '';

$path_upload = 'uploads/conductors/';
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
                    <span class="bg-gradient-gray" style="margin-top: 3px"> <i class="fas fa-clock text-warning "></i></i> <strong> {{__('global.updated_at')}}</strong>: {{ $updated_at }}</span>
                </div>
                <!--   ================================================================================-->
                <div>
                    <i class="fas fa-list bg-info"></i>
                    <div class="timeline-item">
                        <div class="timeline-header">
                            <strong>{{__('conductors.type')}}</strong>: {{$conductor->type ?? ''}}
                            <hr>
                            <strong>{{__('conductors.cross_section')}}</strong>: {{$conductor->cross_section ?? ''}}
                            <hr>
                            <strong>{{__('conductors.diameter')}}</strong>: {{$conductor->diameter ?? ''}}
                            <hr>
                            <strong>{{__('conductors.mass')}}</strong>: {{$conductor->mass ?? ''}}
                            <hr>
                            <strong>{{__('conductors.model')}}</strong>: {{$conductor->model ?? ''}}
                            <hr>
                            @php
                                $v = sprintf('%.15f', (float)$conductor->temp_exp_coeff); // доволно децимали
                                $v = rtrim(rtrim($v, '0'), '.'); // тргни trailing zeros и точка
                            @endphp
                            <strong>{{__('conductors.temp_exp_coeff')}}</strong>: {{$v ?? ''}}
                            <hr>
                            <strong>{{__('conductors.allowable_stress_normal')}}</strong>: {{$conductor->allowable_stress_normal ?? ''}}
                            <hr>
                            <strong>{{__('conductors.allowable_stress_emergency')}}</strong>: {{$conductor->allowable_stress_emergency ?? ''}}
                        </div>
                    </div>
                </div>
                <!--   ================================================================================-->
                <div>
                    <i class="fas fa-users bg-gradient-red"></i>
                    <div class="timeline-item">
                        <div class="timeline-header">
                            <i class="fas fa-user  text-warning"></i> <strong>{{__('global.created_by')}}</strong>: <b class="text-danger">{{$created_by}}</b>, <span class="text-danger">{{$conductor->createdBy->name ?? ''}} {{$conductor->createdBy->surname ?? ''}}</span><br>
                            <i class="fas fa-user  text-warning"></i> <strong>{{__('global.updated_by')}}</strong>: <b class="text-danger">{{$updated_by}}</b>,  <span class="text-danger">{{$conductor->updatedBy->name ?? ''}} {{$conductor->updatedBy->surname ?? ''}}</span>


                        </div>
                    </div>
                </div>
                <!--   ================================================================================-->
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




