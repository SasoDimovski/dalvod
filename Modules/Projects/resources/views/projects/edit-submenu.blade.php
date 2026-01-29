@php
    $isEndpoints = request()->is('*edit_endpoints*');
    $isPoints    = request()->is('*edit_points*');
    $isPoint    = request()->is('*edit_point*');
    $isRaspres   = request()->is('*edit_raspres*');
    $isZatpol    = request()->is('*edit_zatpol*');
    $isGapres    = request()->is('*edit_gapres*');
    $isEdit      = request()->is('*edit/'.$id);
@endphp

<div class="col-sm-12 col-md-12 col-lg-12 col-xl-6">

    <a href="{{ $url_edit.'/'.$id.'?' }}"
       class="btn {{ $isEdit ? 'btn-success' : 'btn-very-light' }}">
        {{ __('projects.edit.menu.edit') }}
    </a>

    <a href="{{ $url_edit_endpoints.'/'.$id.'?' }}"
       class="btn {{ $isEndpoints ? 'btn-success' : 'btn-very-light' }}">
        {{ __('projects.edit.menu.endpoints') }}
    </a>


    <a href="{{ $url_edit_points.'/'.$id.'?' }}"
       class="btn {{ ($isPoints || $isPoint) ? 'btn-success' : 'btn-very-light' }}">
        {{ __('projects.edit.menu.points') }}
    </a>

    <button class="btn modal90 {{ $isRaspres ? 'btn-success' : 'btn-very-light' }}"
            onclick="getContentID('{{ $url_edit_raspres.'/'.$id.'?' }}',
                                  'ModalShow',
                                  '{{ __('projects.edit.menu.raspres_long') }}')">
        {{ __('projects.edit.menu.raspres') }}
    </button>

    <button class="btn modal90 {{ $isZatpol ? 'btn-success' : 'btn-very-light' }}"
            onclick="getContentID('{{ $url_edit_zatpol.'/'.$id.'?' }}',
                                  'ModalShow',
                                  '{{ __('projects.edit.menu.zatpol_long') }}')">
        {{ __('projects.edit.menu.zatpol') }}
    </button>

    <button class="btn modal90 {{ $isGapres ? 'btn-success' : 'btn-very-light' }}"
            onclick="getContentID('{{ $url_edit_gapres.'/'.$id.'?' }}',
                                  'ModalShow',
                                  '{{ __('projects.edit.menu.gapres_long') }}')">
        {{ __('projects.edit.menu.gapres') }}
    </button>

</div>
<style>
    .btn-very-light {
        background-color: #dcdcdc;
        color: #333;
    }
    .btn-very-light:hover {
        background-color: #cacaca;
        color: #000b16;
    }
</style>
