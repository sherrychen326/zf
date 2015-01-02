<?php
namespace Blog\Model;


//class Blog implements InputFilterAwareInterface
class Poem
{
	public $poem_id;
	public $author_id;
	public $title;
	public $content;

	public function exchangeArray($data)
	{
		$this->poem_id     = (isset($data['poem_id']))     ? $data['poem_id']     : null;
		$this->author_id = (isset($data['author_id'])) ? $data['author_id'] : null;
		$this->title  = (isset($data['title']))  ? $data['title']  : null;
		$this->content  = (isset($data['content']))  ? $data['content']  : null;
	}
}