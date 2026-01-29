<?php

namespace Modules\GroundWires\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GroundWires\Dto\GroundWiresDto;
use Modules\GroundWires\Http\Requests\GroundWiresStoreRequest;
use Modules\GroundWires\Http\Requests\GroundWiresUpdateRequest;
use Modules\GroundWires\Services\GroundWiresServices;

class GroundWiresController extends Controller
{
    public function __construct(public GroundWiresServices $groundwiresServices, private readonly GroundWiresDto $groundwiresDto)
    {
    }
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $return = $this->groundwiresServices->index($request->all());
        return view('GroundWires::groundwires/index', $return['data']);

    }


    public function show($lang, $id_module, $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $return = $this->groundwiresServices->show($id);
        return view('GroundWires::groundwires/show', $return['data']);
    }

    public function edit($lang, $id_module, $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $return = $this->groundwiresServices->edit($id);
        return view('GroundWires::groundwires/edit', $return['data']);
    }


    public function create($lang, $id_module): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $return = $this->groundwiresServices->create();
        return view('GroundWires::groundwires/edit', $return['data']);
    }

    public function store(GroundWiresStoreRequest $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $url_return= $request->get('url_return') ;
        $query= $request->get('query') ;
        $message_error= $request->get('message_error') ;
        $message_success= $request->get('message_success') ;

        $groundwiresDto = $this->groundwiresDto->fromRequest($request);
        $return = $this->groundwiresServices->store($groundwiresDto);


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


    public function update(GroundWiresUpdateRequest $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $url_return= $request->get('url_return') ;
        $query= $request->get('query') ;
        $message_error= $request->get('message_error') ;
        $message_success= $request->get('message_success') ;

        //dd($request->get('file_name_hidden'));

        $groundwiresDto = $this->groundwiresDto->fromRequest($request);
        $return = $this->groundwiresServices->update($request->get('file_name_hidden'), $groundwiresDto);


        if($return->status=='error'){
            $errors = [
                "1" => __('groundwires.groundwiresController.error_tower_not_exist'),
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

        $return = $this->groundwiresServices->delete($id);

        if($return->status=='error'){
            $errors = [
                "1" => __('global.delete_error'),
                "2" => __('groundwires.groundwiresController.error_is_used'),

            ];
            $message_error = $errors[$return->data['id_error']] ?? $message_error;

            return redirect(url($url_return).'?'.$query)->with('error', [$message_error, $return->method, $return->class]);
        }
        return redirect(url($url_return).'?'.$query)->with('success', $message_success);
    }
}
