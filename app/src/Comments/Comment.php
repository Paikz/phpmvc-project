<?php
namespace phes15\Comments;

// UserModel
class Comment extends \phes15\MVC\CDatabaseModel
{
    public function setup()
    {
      $this->db->dropTableIfExists('comment')->execute();
		  $this->db->createTable(
			'comment',
			[
				'id' 			=> ['integer', 'primary key', 'not null', 'auto_increment'],
				'userId' 		=> ['integer'],
				'commentKey' 	=> ['integer', 'not null'],
				'commentType' 	=> ['varchar(80)'],
				'mail' 			=> ['varchar(80)'],
				'web' 			=> ['varchar(200)'],
				'gravatar' 		=> ['varchar(200)'],
				'content' 		=> ['text', 'not null'],
				'timestamp' 	=> ['datetime'],
			]
		)->execute();
		$now = gmdate('Y-m-h H:i:s');
		$this->di->db->insert(
			'comment',
			['userId', 'commentKey', 'commentType', 'mail', 'web', 'gravatar', 'content', 'timestamp']
		);
		$this->di->db->execute([
			2,
			1,
			'question',
			'doe@student.bth.se',
			'http://www.google.se',
			'http://www.gravatar.com/avatar/none.jpg',
			'Comment to the question.',
			$now,
		]);
		
    }

    public function findAll($key = null, $type = null)
  	{
  		if (isset($key) && isset($type)) {
  			$this->db->select()
  				     ->from($this->getDataSource())
  				     ->where('commentKey = ?')
  				     ->andWhere('commentType = ?');
  			$this->db->execute([$key, $type]);
  			$this->db->setFetchModeClass(__CLASS__);
  			return $this->db->fetchAll();
  		} else {
  			parent::findAll();
  		}
  	}

	public function findComment($id, $key = null, $type = null)
	{
		if (isset($pageKey)) {
			$this->db->select()
			         ->from($this->getDataSource())
			         ->where("id = ?")
			         ->andWhere("commentKey = ?")
			         ->andWhere("commentType = ?");
			$this->db->execute([$id, $key]);
			return $this->db->fetchInto($this);
		}
	}

	public function findCommentByUserId($id, $sort = 'id DESC', $limit = null)
	{
		$this->db->select()
		  		 ->from($this->getDataSource())
		  		 ->where('userId = ?');
		$this->db->execute([$id]);
		$this->db->setFetchModeClass(__CLASS__);
		return $this->db->fetchAll();
	}

	public function deleteAll()
	{
		$this->db->delete(
			$this->getDatasource()
		);
		return $this->db->execute();
	}
}
