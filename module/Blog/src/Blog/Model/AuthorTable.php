<?php
namespace Blog\Model;
use Zend\Db\TableGateway\TableGateway;

class AuthorTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll()
	{
		$resultSet = $this->tableGateway->select();
		return $resultSet;
	}

	public function getAuthor($id)
	{
		$id  = (int) $id;
		$rowset = $this->tableGateway->select(array('author_id' => $id));
		$row = $rowset->current();
		if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}

	/*public function saveBlog(Blog $Blog)
	{
		$data = array(
				'artist' => $Blog->artist,
				'title'  => $Blog->title,
		);

		$id = (int) $Blog->id;
		if ($id == 0) {
			$this->tableGateway->insert($data);
		} else {
			if ($this->getBlog($id)) {
				$this->tableGateway->update($data, array('id' => $id));
			} else {
				throw new \Exception('Blog id does not exist');
			}
		}
	}

	public function deleteBlog($id)
	{
		$this->tableGateway->delete(array('id' => (int) $id));
	}*/
}