<?php
namespace Blog\Model;


//class Blog implements InputFilterAwareInterface
class Author
{
	public $author_id;
	public $name;


	public function exchangeArray($data)
	{
		
		$this->author_id = (isset($data['author_id'])) ? $data['author_id'] : null;
		$this->name  = (isset($data['name']))  ? $data['name']  : null;
	
	}
}