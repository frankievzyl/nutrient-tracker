<?php
	class PostsController {
		public function index() {
			
			// we store all the posts in a variable
			$posts = Post::all();
			require_once('views/posts/index.php');
		}

		public function show() {

			// we expect a url of form ?controller=posts&action=show&id=x
			if (!isset($_GET['id'])) {
				return call('pages', 'error');
			}

			$post = Post::find($_GET['id']);
			require_once('views/posts/show.php');
		}

	}
?>