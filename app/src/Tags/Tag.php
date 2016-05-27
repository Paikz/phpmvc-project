<?php
namespace phes15\Tags;

class Tag extends \phes15\MVC\CDatabaseModel
{
  public function setup()
  {
    $this->db->dropTableIfExists('tag')->execute();
		$this->db->createTable(
			'tag',
			[
				'id' 			=> ['integer', 'primary key', 'not null', 'auto_increment'],
				'name' 		=> ['varchar(80)', 'unique'],
				'slug' 			=> ['varchar(80)', 'unique'],
			]
		)->execute();

		$now = gmdate('Y-m-h H:i:s');

		$this->db->insert(
			'tag',
			['name', 'slug']
		);
		$this->db->execute([
			'Strength',
			'strength',
		]);
		$this->db->execute([
			'Dexterity',
			'dexterity',
		]);
		$this->db->execute([
			'Help',
			'help',
		]);
    $this->db->execute([
			'Guide',
			'guide',
		]);
    $this->db->execute([
			'PVP',
			'pvp',
		]);
    $this->db->execute([
			'PVE',
			'pve',
		]);
    $this->db->execute([
			'Boss',
			'boss',
		]);
    $this->db->execute([
			'Item',
			'item',
		]);
  }

  public function findBySlug($slug)
	{
  		$this->db->select()
  				 ->from($this->getDataSource())
  				 ->where('slug = ?');
  		$this->db->execute([$slug]);
  		return $this->db->fetchInto($this);
	}
	public function findByName($name)
	{
  		$this->db->select()
  				 ->from($this->getDataSource())
  				 ->where('name = ?');
  		$this->db->execute([$name]);
  		return $this->db->fetchInto($this);
	}
	public function findMostUsedTags($limit)
	{
  		$this->db->select('id, name, slug, count(name) as number')
  				 ->from($this->getDataSource())
  				 ->where('idTag = id')
  				 ->leftJoin('questiontag', 'idTag = id')
  				 ->groupBy('name')
  				 ->orderBy('number DESC')
  				 ->limit($limit);
  		$this->db->execute();
  		$this->db->setFetchModeClass(__CLASS__);
  		return $this->db->fetchAll();
	}
	public function getIdBySlug($slug)
	{
		$this->db->select('id')
			 ->from($this->getDataSource())
			 ->where('slug = ?');

		$this->db->execute([$slug]);
		$id = $this->db->fetchInto($this)->getProperties()['id'];
		return $id;
	}

}
