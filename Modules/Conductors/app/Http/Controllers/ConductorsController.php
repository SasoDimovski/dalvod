<?php

namespace Modules\Conductors\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Conductors\Dto\ConductorsDto;
use Modules\Conductors\Http\Requests\ConductorsStoreRequest;
use Modules\Conductors\Http\Requests\ConductorsUpdateRequest;
use Modules\Conductors\Services\ConductorsServices;

class ConductorsController extends Controller
{
    public function __construct(public ConductorsServices $conductorsServices, private readonly ConductorsDto $conductorsDto)
    {
    }
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $return = $this->conductorsServices->index($request->all());
        return view('Conductors::conductors/index', $return['data']);

    }


    public function show($lang, $id_module, $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $return = $this->conductorsServices->show($id);
        return view('Conductors::conductors/show', $return['data']);
    }

    public function edit($lang, $id_module, $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $return = $this->conductorsServices->edit($id);
        return view('Conductors::conductors/edit', $return['data']);
    }


    public function create($lang, $id_module): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $return = $this->conductorsServices->create();
        return view('Conductors::conductors/edit', $return['data']);
    }

    public function store(ConductorsStoreRequest $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $url_return= $request->get('url_return') ;
        $query= $request->get('query') ;
        $message_error= $request->get('message_error') ;
        $message_success= $request->get('message_success') ;

        $conductorsDto = $this->conductorsDto->fromRequest($request);
        $return = $this->conductorsServices->store($conductorsDto);


        if($return->status=='error'){
            $errors = [
                "1" => __('global.store_error'),
            ];

            $message_error = $errors[$return->data['id_error']] ?? $message_error;
            return redirect(url($url_return).'?'.$query)->with('error',[
                $message_error,
                $return->method,
                $return->class,
            ]);
        }

        // dd($return->data['id']);
        return redirect(url($url_return.$return->data['id']).'?'.$query)->with('success', $message_success);

    }


    public function update(ConductorsUpdateRequest $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $url_return= $request->get('url_return') ;
        $query= $request->get('query') ;
        $message_error= $request->get('message_error') ;
        $message_success= $request->get('message_success') ;

        //dd($request->get('file_name_hidden'));

        $conductorsDto = $this->conductorsDto->fromRequest($request);
        $return = $this->conductorsServices->update($request->get('file_name_hidden'), $conductorsDto);


        if($return->status=='error'){
            $errors = [
                "1" => __('conductors.conductorsController.error_tower_not_exist'),
                "2" => __('global.update_error'),
            ];

            $message_error = $errors[$return->data['id_error']] ?? $message_error;
            //dd($errorMessage);
            return redirect(url($url_return).'?'.$query)->with('error',[
                $message_error,
                $return->method,
                $return->class,
            ]);
        }
        //dd($message_success);
        return redirect(url($url_return).'?'.$query)->with('success', $message_success);

    }


    public function destroy($lang, $id_module, $id, Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {

        $url_return= $request->get('url_return_war') ;
        $query= $request->get('query_war') ;
        $message_error= $request->get('error_war') ;
        $message_success= $request->get('success_war') ;

        $return = $this->conductorsServices->delete($id);

        if($return->status=='error'){
            $errors = [
                "1" => __('global.delete_error'),
                "2" => __('conductors.conductorsController.error_is_used'),

            ];
            $message_error = $errors[$return->data['id_error']] ?? $message_error;

            return redirect(url($url_return).'?'.$query)->with('error', [$message_error, $return->method, $return->class]);
        }
        return redirect(url($url_return).'?'.$query)->with('success', $message_success);
    }
}
