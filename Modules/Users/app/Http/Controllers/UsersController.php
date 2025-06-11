<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Modules\Users\Dto\UsersDto;
use Modules\Users\Emails\UsersRegistrationMail;
use Modules\Users\Http\Requests\UsersUpdateRequest;
use Modules\Users\Services\UsersServices;


class UsersController extends Controller
{
    public function __construct(public UsersServices $usersServices, private readonly UsersDto $usersDto)
    {
    }

    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $return = $this->usersServices->index($request->all());
        return view('Users::users/index', $return['data']);

    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $return = $this->usersServices->create();
        return view('Users::users/edit', $return['data']);
    }

    public function store(UsersUpdateRequest $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $url_return= $request->get('url_return') ;
        $query= $request->get('query') ;
        $message_error= $request->get('message_error') ;
        $message_success= $request->get('message_success') ;

        $usersDto = $this->usersDto->fromRequest($request);
        $return = $this->usersServices->store($usersDto);

        if($return->status=='error'){
            $errors = [
                "1" => __('users.UsersController.error_store_user'),
                "2" => __('users.UsersController.error_create_save_hash'),
                "3" => __('users.UsersController.error_send_email'),
                "4" => __('users.UsersController.error_update_paas_in_pass'),
                "5" => __('users.UsersController.error_update_paas_in_users'),
                "6" => __('users.UsersController.error_update_paas_in_users'),
            ];

            $errorMessage = $errors[$return->data['id_error']] ?? $message_error;
            //dd($errorMessage);
            return redirect(url($url_return).'?'.$query)->with('error',[
                $errorMessage,
                $return->method,
                $return->class,
            ]);
        }
        return redirect(url($url_return.'/'.$return->data['id']).'?'.$query)->with('success', $message_success);

    }

    public function show($lang, $id_module, $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $return = $this->usersServices->show($id);
        return view('Users::users/show', $return['data']);
    }

    public function edit($lang, $id_module, $id): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $return = $this->usersServices->edit($lang, $id);
        return view('Users::users/edit', $return['data']);
    }

    public function update(UsersUpdateRequest $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $url_return= $request->get('url_return') ;
        $query= $request->get('query') ;
        $message_error= $request->get('message_error') ;
        $message_success= $request->get('message_success') ;

        $usersDto = $this->usersDto->fromRequest($request);
        $return = $this->usersServices->update($request->get('file_name_hidden'), $usersDto);


        if($return->status=='error'){
            $errors = [
                "1" => __('users.UsersController.error_user_not_exist'),
                "2" => __('users.UsersController.error_password_used'),
                "3" => __('users.UsersController.error_update_user'),
                "4" => __('users.UsersController.error_update_paas_in_pass'),
                "5" => __('users.UsersController.error_update_paas_in_users'),
            ];

            $errorMessage = $errors[$return->data['id_error']] ?? $message_error;
            //dd($errorMessage);
            return redirect(url($url_return).'?'.$query)->with('error',[
                $errorMessage,
               $return->method,
                $return->class,
            ]);
        }
        return redirect(url($url_return).'?'.$query)->with('success', $message_success);

    }

    public function sendEmailReg($lang, $id_module, $id, Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $url_return= $request->get('url_return_war') ;
        $query= $request->get('query_war') ;
        $message_error= $request->get('error_war') ;
        $message_success= $request->get('success_war') ;

        $return = $this->usersServices->sendEmailReg($id);

        if($return->status=='error'){
            return redirect(url($url_return).'?'.$query)->with('error', [$message_error, $return->method, $return->class]);
        }
        return redirect(url($url_return).'?'.$query)->with('success', $message_success);
    }

    public function destroy($lang, $id_module, $id, Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {

        $url_return= $request->get('url_return_war') ;
        //dd($url_return);
        $query= $request->get('query_war') ;
        $message_error= $request->get('error_war') ;
        $message_success= $request->get('success_war') ;

        $return = $this->usersServices->deleteUser($id);

        if($return->status=='error'){
            return redirect(url($url_return).'?'.$query)->with('error', [$message_error, $return->method, $return->class]);
        }
        return redirect(url($url_return).'?'.$query)->with('success', $message_success);
    }

    public function addGroupToUser($lang, $id_module, $id_user, $id_group, Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $url_return= $request->get('url_return_war') ;
        $query= $request->get('query_war') ;
        $message_error= $request->get('error_war') ;
        $message_success= $request->get('success_war') ;

        $return = $this->usersServices->addGroupToUser($id_user, $id_group);

        if($return->status=='error'){
            return redirect(url($url_return).'?'.$query)->with('error', [$message_error, $return->method, $return->class]);
        }
        return redirect(url($url_return).'?'.$query)->with('success', $message_success);
    }

    public function removeGroupToUser($lang, $id_module, $id_user, $id_group, Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $url_return= $request->get('url_return_war') ;
        $query= $request->get('query_war') ;
        $message_error= $request->get('error_war') ;
        $message_success= $request->get('success_war') ;

        $return = $this->usersServices->removeGroupToUser($id_user, $id_group);

        if($return->status=='error'){
            return redirect(url($url_return).'?'.$query)->with('error', [$message_error, $return->method, $return->class]);
        }
        return redirect(url($url_return).'?'.$query)->with('success', $message_success);

    }

}
