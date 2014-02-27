<?php
class Controller_Posts extends Controller_Template{

	public function before()
	{
		parent::before();
		if (!Auth::check())	
		{
			Response::redirect('auth/login');
		}
	}

	/**
	 * post一覧
	 */
	public function action_index()
	{
		$data['posts'] = Model_Post::find('all', array(
			'order_by' => array('updated_at' => 'desc'),
			'where' => array(
				array('user_id', Auth::get_user_id()[1])
			)
		));
		$this->template->title = "Posts";
		$this->template->content = View::forge('posts/index', $data);
	}

	/**
	 * post作成
	 */
	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Post::validate('create');
			
			if ($val->run())
			{
				$post = Model_Post::forge(array(
					'user_id' => Auth::get_user_id()[1],
					'content' => Input::post('content'),
				));

				if ($post and $post->save())
				{
					Session::set_flash('success', 'Added post #'.$post->id.'.');
					Response::redirect('posts');
				}
				else
				{
					Session::set_flash('error', 'Could not save post.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Posts";
		$this->template->content = View::forge('posts/create');
	}



	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('posts');

		if ( ! $post = Model_Post::find($id))
		{
			Session::set_flash('error', 'Could not find post #'.$id);
			Response::redirect('posts');
		}

		$val = Model_Post::validate('edit');

		if ($val->run())
		{
			$post->user_id = Auth::get_user_id()[1];
			$post->content = Input::post('content');

			if ($post->save())
			{
				Session::set_flash('success', 'Updated post #' . $id);
				Response::redirect('posts');
			}
			else
			{
				Session::set_flash('error', 'Could not update post #' . $id);
			}
		}
		else
		{
			if (Input::method() == 'POST')
			{
				$post->user_id = $val->validated('user_id');
				$post->content = $val->validated('content');
				Session::set_flash('error', $val->error());
			}
			$this->template->set_global('post', $post, false);
		}

		$this->template->title = "Posts";
		$this->template->content = View::forge('posts/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('posts');

		if ($post = Model_Post::find($id))
		{
			$post->delete();

			Session::set_flash('success', 'Deleted post #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete post #'.$id);
		}

		Response::redirect('posts');

	}


	// public function action_view($id = null)
	// {
	// 	is_null($id) and Response::redirect('posts');

	// 	if ( ! $data['post'] = Model_Post::find($id))
	// 	{
	// 		Session::set_flash('error', 'Could not find post #'.$id);
	// 		Response::redirect('posts');
	// 	}

	// 	$this->template->title = "Post";
	// 	$this->template->content = View::forge('posts/view', $data);
	// }
}
