<?php

// Class definition
class Model_Post extends ORM
{
	protected $_has_many = array(
		'comments' => array('model' => 'comment')
	);
}



// Example: Update a post's title
$post = ORM::factory('post')->find(2);
$post->title = 'New Post Title';
$post->save();

// Example: Get the comments for a post
$post = ORM::factory('post')->find(2);
$comments = $post->comments->find_all();