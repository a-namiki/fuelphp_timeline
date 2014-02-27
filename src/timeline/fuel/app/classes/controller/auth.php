<?php

class Controller_Auth extends Controller_Template
{
    public function action_login()
    {
        $data = array();
        if (Input::post())
        {
            if ( ! \Security::check_token()) {
                Response::redirect('error');
                return;
            }
            if (Auth::login())
            {
                Response::redirect('posts');
            }
            else
            {
                $data['username']    = Input::post('username');
                Session::set_flash('error', 'Wrong username/password combo. Try again');
            }
        }

        $this->template->title = 'ログイン';
        $this->template->content = View::forge('auth/login',$data);
    }

}
