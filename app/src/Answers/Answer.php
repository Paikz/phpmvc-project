<?php
namespace phes15\Answers;

// UserModel
class Answer extends \phes15\MVC\CDatabaseModel
{
  public function setup()
  {
    $this->db->dropTableIfExists('answer')->execute();
    $this->db->createTable(
      'answer',
      [
        'id' 		 => ['integer', 'primary key', 'not null', 'auto_increment'],
        'idQuestion' => ['integer', 'not null'],
        'content' 	 => ['text', 'not null'],
        'userId'	 => ['integer'],
        'created' 	 => ['datetime'],
      ]
    )->execute();
    $now = gmdate('Y-m-h H:i:s');
    $this->db->insert(
      'answer',
      ['idQuestion', 'content', 'userId', 'created']
    );
    $this->db->execute([
      1,
      'This is an answer.',
      2,
      $now,
    ]);
    $this->db->execute([
      2,
      'This is an answer.(2)',
      2,
      $now,
    ]);
  }

  public function findAll($idQuestion = null)
	{
		if (isset($idQuestion)) {
			$this->db->select()
				     ->from($this->getDataSource())
				     ->where('idQuestion = ?');
			$this->db->execute([$idQuestion]);
			$this->db->setFetchModeClass(__CLASS__);
			return $this->db->fetchAll();
		} else {
			parent::findAll();
		}
	}

	public function findAnswerByUserId($idUser, $sort = 'id DESC', $limit = 100)
	{
		$this->db->select()
				 ->from($this->getDataSource())
				 ->where('userId = ?')
				 ->orderBy($sort)
				 ->limit($limit);
		$this->db->execute([$idUser]);
		$this->db->setFetchModeClass(__CLASS__);
		return $this->db->fetchAll();
	}

  public function deleteAllComments($id, $prefix = '')
	{
		$sql = "delete from " . $prefix . "comment WHERE commentKey = ? AND commentType = ?";
		$this->db->execute($sql, array($id, 'answer'));
	}

	public function getNumberOfAnswers($idQuestion = null)
	{
		$this->db->select('count(id) as answers')
				 ->from($this->getDataSource())
				 ->where('idQuestion = ?');
		$this->db->execute([$idQuestion]);
		return $this->db->fetchInto($this)->getProperties()['answers'];
	}

}
