<?php

namespace Modules\Towers\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Towers\Dto\TowersDto;
use Modules\Towers\Http\Requests\TowersStoreRequest;
use Modules\Towers\Http\Requests\TowersUpdateRequest;
use Modules\Towers\Services\TowersServices;

class TowersController extends Controller
{
    public function __construct(public TowersServices $towersServices, private readonly TowersDto $towersDto)
    {
    }
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $return = $this->towersServices->index($request->all());
        return view('Towers::towers/index', $return['data']);

    }


    public function show($lang, $id_module, $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $return = $this->towersServices->show($id);
        return view('Towers::towers/show', $return['data']);
    }

    public function edit($lang, $id_module, $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $return = $this->towersServices->edit($id);
        return view('Towers::towers/edit', $return['data']);
    }


    public function create($lang, $id_module): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $return = $this->towersServices->create();
        return view('Towers::towers/edit', $return['data']);
    }

    public function store(TowersStoreRequest $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {

        $url_return= $request->get('url_return') ;
        $query= $request->get('query') ;
        $message_error= $request->get('message_error') ;
        $message_success= $request->get('message_success') ;

       // dd($url_return);

        $towersDto = $this->towersDto->fromRequest($request);
        $return = $this->towersServices->store($towersDto);


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
        return redirect(url($url_return.$return->data['id']).'?'.$query)->with('success', $message_success);

    }


    public function update(TowersUpdateRequest $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $url_return= $request->get('url_return') ;
        $query= $request->get('query') ;
        $message_error= $request->get('message_error') ;
        $message_success= $request->get('message_success') ;

        $towersDto = $this->towersDto->fromRequest($request);
        $return = $this->towersServices->update($request->get('file_name_hidden'),$towersDto);


        if($return->status=='error'){
            $errors = [
                "1" => __('towers.towersController.error_tower_not_exist'),
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
        return redirect(url($url_return).'?'.$query)->with('success', $message_success);

    }


    public function destroy($lang, $id_module, $id, Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {

        $url_return= $request->get('url_return_war') ;
        $query= $request->get('query_war') ;
        $message_error= $request->get('error_war') ;
        $message_success= $request->get('success_war') ;

        $return = $this->towersServices->delete($id);

        if($return->status=='error'){
            $errors = [
                "1" => __('global.delete_error'),
                "2" => __('towers.towersController.error_is_used'),

            ];
            $message_error = $errors[$return->data['id_error']] ?? $message_error;

            return redirect(url($url_return).'?'.$query)->with('error', [$message_error, $return->method, $return->class]);
        }
        return redirect(url($url_return).'?'.$query)->with('success', $message_success);
    }
}
