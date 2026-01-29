<?php

namespace Modules\Insulators\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Insulators\Dto\InsulatorsDto;
use Modules\Insulators\Http\Requests\InsulatorsStoreRequest;
use Modules\Insulators\Http\Requests\InsulatorsUpdateRequest;
use Modules\Insulators\Services\InsulatorsServices;

class InsulatorsController extends Controller
{
    public function __construct(public InsulatorsServices $insulatorsServices, private readonly InsulatorsDto $insulatorsDto)
    {
    }
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $return = $this->insulatorsServices->index($request->all());
        return view('Insulators::insulators/index', $return['data']);

    }


    public function show($lang, $id_module, $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $return = $this->insulatorsServices->show($id);
        return view('Insulators::insulators/show', $return['data']);
    }

    public function edit($lang, $id_module, $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $return = $this->insulatorsServices->edit($id);
        return view('Insulators::insulators/edit', $return['data']);
    }


    public function create($lang, $id_module): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $return = $this->insulatorsServices->create();
        return view('Insulators::insulators/edit', $return['data']);
    }

    public function store(InsulatorsStoreRequest $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $url_return= $request->get('url_return') ;
        $query= $request->get('query') ;
        $message_error= $request->get('message_error') ;
        $message_success= $request->get('message_success') ;

        $insulatorsDto = $this->insulatorsDto->fromRequest($request);
        $return = $this->insulatorsServices->store($insulatorsDto);


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


    public function update(InsulatorsUpdateRequest $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $url_return= $request->get('url_return') ;
        $query= $request->get('query') ;
        $message_error= $request->get('message_error') ;
        $message_success= $request->get('message_success') ;

        //dd($request->get('file_name_hidden'));

        $insulatorsDto = $this->insulatorsDto->fromRequest($request);
        $return = $this->insulatorsServices->update($request->get('file_name_hidden'), $insulatorsDto);


        if($return->status=='error'){
            $errors = [
                "1" => __('insulators.insulatorsController.error_tower_not_exist'),
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

        $return = $this->insulatorsServices->delete($id);

        if($return->status=='error'){
            $errors = [
                "1" => __('global.delete_error'),
                "2" => __('insulators.insulatorsController.error_is_used'),

            ];
            $message_error = $errors[$return->data['id_error']] ?? $message_error;

            return redirect(url($url_return).'?'.$query)->with('error', [$message_error, $return->method, $return->class]);
        }
        return redirect(url($url_return).'?'.$query)->with('success', $message_success);
    }
}
