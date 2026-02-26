@php
    $isEndpoints = request()->is('*edit_endpoints*');
    $isPoints    = request()->is('*edit_points*');
    $isPoint    = request()->is('*edit_point*');
    $isRaspres   = request()->is('*show_raspres*');
    $isZatpol    = request()->is('*show_zatpol*');
    $isGapres    = request()->is('*show_gapres*');
    $isCalculations    = request()->is('*calculations*');
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
            onclick="getContentID('{{ $url_show_raspres.'/'.$id.'?' }}',
                                  'ModalShow',
                                  '{{ __('projects.edit.menu.raspres_long') }}')">
        {{ __('projects.edit.menu.raspres') }}
    </button>

    <button class="btn modal90 {{ $isZatpol ? 'btn-success' : 'btn-very-light' }}"
            onclick="getContentID('{{ $url_show_zatpol.'/'.$id.'?' }}',
                                  'ModalShow',
                                  '{{ __('projects.edit.menu.zatpol_long') }}')">
        {{ __('projects.edit.menu.zatpol') }}
    </button>

    <button class="btn modal90 {{ $isGapres ? 'btn-success' : 'btn-very-light' }}"
            onclick="getContentID('{{ $url_show_gapres.'/'.$id.'?' }}',
                                  'ModalShow',
                                  '{{ __('projects.edit.menu.gapres_long') }}')">
        {{ __('projects.edit.menu.gapres') }}
    </button>

    <button class="btn modal90 {{ $isCalculations ? 'btn-success' : 'btn-very-light' }}"
            onclick="getContentID('{{ $url_all_tables.'/'.$id.'?' }}',
                                  'ModalShow',
                                  '{{ __('projects.edit.menu.calculations_long') }}')">
        {{ __('projects.edit.menu.calculations') }}
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
