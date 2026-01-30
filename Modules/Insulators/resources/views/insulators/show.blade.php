<?php
$id_module = $module->id ?? '';
$lang = request()->segment(2);
$query = request()->getQueryString();

$id = $insulator->id ?? '';


$picture = $insulator->picture ?? '';
$active = $insulator->active ?? '';
$deleted = $insulator->deleted ?? '';
$created_at = (isset($insulator->created_at)) ? date("d.m.Y  H:i:s", strtotime($insulator->created_at)) : '';
$updated_at = (isset($insulator->updated_at)) ? date("d.m.Y  H:i:s", strtotime($insulator->updated_at)) : '';
$created_by = $insulator->createdBy->username ?? '';
$updated_by = $insulator->updatedBy->username ?? '';

$path_upload = 'uploads/insulators/';
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
                            <strong>{{__('insulators.sifra')}}</strong>: {{$insulator->sifra ?? ''}}
                            <hr>
                            <strong>{{__('insulators.type')}}</strong>: {{$insulator->type ?? ''}}
                            <hr>
                            <strong>{{__('insulators.voltage')}}</strong>: {{$insulator->voltage ?? ''}}
                            <hr>
                            <strong>{{__('insulators.length')}}</strong>: {{$insulator->length ?? ''}}
                            <hr>
                            <strong>{{__('insulators.mass')}}</strong>: {{$insulator->mass ?? ''}}
                            <hr>
                            <strong>{{__('insulators.massd')}}</strong>: {{$insulator->massd ?? ''}}
                            <hr>
                            <strong>{{__('insulators.id_insulator_chain')}}</strong>: {{$insulator->insulatorChain->title ?? ''}}
                            <hr>
                            <strong>{{__('insulators.support_insulator')}}</strong>: {{$insulator->support_insulator ?? ''}}
                            <hr>
                            <strong>{{__('insulators.insulator_material')}}</strong>: {{$insulator->insulator_material?? ''}}
                            <hr>
                            <strong>{{__('insulators.number')}}</strong>: {{$insulator->number ?? ''}}
                            <hr>
                            <strong>{{__('insulators.breaking_load')}}</strong>: {{$insulator->breaking_load ?? ''}}
                        </div>
                    </div>
                </div>
                <!--   ================================================================================-->
                <div>
                    <i class="fas fa-users bg-gradient-red"></i>
                    <div class="timeline-item">
                        <div class="timeline-header">
                            <i class="fas fa-user  text-warning"></i> <strong>{{__('global.created_by')}}</strong>: <b class="text-danger">{{$created_by}}</b>, <span class="text-danger">{{$insulator->createdBy->name ?? ''}} {{$insulator->createdBy->surname ?? ''}}</span><br>
                            <i class="fas fa-user  text-warning"></i> <strong>{{__('global.updated_by')}}</strong>: <b class="text-danger">{{$updated_by}}</b>,  <span class="text-danger">{{$insulator->updatedBy->name ?? ''}} {{$insulator->updatedBy->surname ?? ''}}</span>


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




