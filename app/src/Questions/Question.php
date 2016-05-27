<?php
namespace phes15\Questions;

class Question extends \phes15\MVC\CDatabaseModel
{
  public function setup()
  {
    $this->db->dropTableIfExists('question')->execute();
		$this->db->createTable(
			'question',
			[
				'id' 			=> ['integer', 'primary key', 'not null', 'auto_increment'],
				'title' 		=> ['varchar(80)'],
				'slug' 			=> ['varchar(80)'],
				'content' 		=> ['text', 'not null'],
				'userId' 		=> ['integer'],
				'created'		=> ['datetime'],
			]
		)->execute();

		$now = gmdate('Y-m-h H:i:s');

		$this->db->insert(
			'question',
			['title', 'slug', 'content', 'userId', 'created']
		);
		$this->db->execute([
			'Help with Nameless King!',
			'help-with-nameless-king',
			'Im stuck. This boss is so hard. I manage to beat the dragon he is sitting on but the second form reks me completely. How should I go about to beat this boss?',
			1,
			$now,
		]);
		$this->db->execute([
			'Dexterity or Strength build?',
			'dexterity-or-strength-build',
			'I played dexterity in the last game but I dont know what to build now. Any tips on a good weapon, maybe uchigatana?',
			1,
			$now,
		]);
		$this->db->execute([
			'How do I enter Dragonpeak valley?',
			'how-do-i-enter.dragonpeak-valley',
			'I heard it is an optional area but I have no idea how to enter it. Any guide on how to do it?',
			1,
			$now,
		]);
  }

  public function findLatestQuestions($limit)
	{
		$this->db->select()
		         ->from($this->getDataSource())
		         ->orderBy("created DESC")
		         ->limit($limit);

		$this->db->execute();
		$this->db->setFetchModeClass(__CLASS__);
		return $this->db->fetchAll();
	}

  public function findQuestionByUserId($id, $limit = 20)
	{
		$this->db->select()
				 ->from($this->getDataSource())
				 ->where("userId = ?")
				 ->limit($limit);
		$this->db->execute([$id]);
		$this->db->setFetchModeClass(__CLASS__);
		return $this->db->fetchAll();
	}

  public function findQuestionByTag($id, $prefix)
	{
		$this->db->select($prefix . 'question.*')
				 ->from($this->getDataSource())
				 ->where('idTag = ?')
				 ->leftJoin('questiontag', $prefix . 'question.id = ' . 'idQuestion')
				 ->leftJoin('tag', $prefix . 'tag.id = ' . $prefix . 'question.id');
		$this->db->execute([$id]);
		$this->db->setFetchModeClass(__CLASS__);
		return $this->db->fetchAll();
	}

  public function findBySlug($slug)
	{
  		$this->db->select()
  				 ->from($this->getDataSource())
  				 ->where('slug = ?');
  		$this->db->execute([$slug]);
  		return $this->db->fetchInto($this);
	}

  public function getSlugByQuestionId($id)
	{
		$this->db->select('slug')
				 ->from($this->getDataSource())
				 ->where('id = ?');
		$this->db->execute([$id]);
		$slug = $this->db->fetchOne();
		return $slug->slug;
	}
}
