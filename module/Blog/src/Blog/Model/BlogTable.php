<?php
namespace Blog\Model;
use Zend\Db\TableGateway\TableGateway;

class BlogTable
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

	public function getPoem($poem_id)
	{
		$poem_id  = (int) $poem_id;
		$rowset = $this->tableGateway->select(array('poem_id' => $poem_id));
		$row = $rowset->current();
		if (!$row) {
			throw new \Exception("Could not find row $poem_id");
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