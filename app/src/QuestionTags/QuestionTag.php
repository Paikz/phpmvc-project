<?php
namespace phes15\QuestionTags;

class QuestionTag extends \phes15\MVC\CDatabaseModel
{
	public function setup()
	{
		$this->db->dropTableIfExists('questiontag')->execute();
		$this->db->createTable(
			'questiontag',
			[
				'idQuestion' => ['integer', 'not null'],
				'idTag'		 => ['integer', 'not null'],
			]
		)->execute();
		$this->db->insert(
			'questiontag',
			['idQuestion', 'idTag']
		);
		$this->db->execute([1, 3]);
		$this->db->execute([1, 4]);
		$this->db->execute([1, 6]);
		$this->db->execute([1, 7]);
		$this->db->execute([2, 1]);
		$this->db->execute([2, 2]);
		$this->db->execute([2, 3]);
    $this->db->execute([2, 4]);
    $this->db->execute([2, 8]);
    $this->db->execute([3, 3]);
    $this->db->execute([3, 4]);
    $this->db->execute([3, 6]);
	}
	public function findTagByQuestionId($idQuestion = null, $prefix)
	{
		$this->db->select($prefix .  'tag.id, name, ' . $prefix . 'tag.slug')
				 ->from($this->getDataSource())
				 ->where('idQuestion = ?')
				 ->leftJoin('tag', 'idTag = ' . $prefix . 'tag.id')
				 ->leftJoin('question', 'idQuestion = ' . $prefix . 'question.id');

		$this->db->execute([$idQuestion]);
		$this->db->setFetchModeClass(__CLASS__);
		return $this->db->fetchAll();
	}
	public function deleteByQuestionId($id)
	{
		$this->db->delete(
			$this->getDataSource(),
			'idQuestion = ?'
		);
		return $this->db->execute([$id]);
	}
}
