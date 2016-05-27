<?php
namespace phes15\Users;

class User extends \phes15\MVC\CDatabaseModel
{
    public function authenticate($username, $password)
    {
        $user = $this->query()
                ->where("username = ?")
                ->execute([$username]);

        if ($user != false)
        {
          $fetchedPassword = $user[0]->password;
          $verify = password_verify($password, $fetchedPassword);
          if ($verify)
          {
            $_SESSION['user'] = [
              'id'          => $user[0]->id,
              'username'    => $user[0]->username,
            ];
            return true;
          }
          else { return false; }
        }
        else { return false; }
    }

    public function isLoggedIn()
    {
      if(isset($_SESSION['user']))
      {
        return true;
      }
      else {return false;}
    }

    public function matchingId($id)
  	{
  		if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $id)
      {return true;}
      else
      {return false;}
  	}

    public function logout()
  	{
  		unset($_SESSION['user']);
  		if (empty($_SESSION['user']))
      {
  			$this->response->redirect('Login');
  			return true;
  		}
      else {return false;}
  	}

    public function usernameTaken($username)
  	{
  		$this->db->select('username')
  				 ->from($this->getDataSource())
  				 ->where('username = ?');
  		$this->db->execute([$username]);
  		$res = $this->db->fetchAll();

  		if ($res)
      {return true;}
      else
      {return false;}
  	}

    public function findUsernameById($id)
    {
        $this->db->select('username')
  				 ->from($this->getDataSource())
  				 ->where('id = ?');
    		$this->db->execute([$id]);
    		$this->db->setFetchModeClass(__CLASS__);
    		return $this->db->fetchAll();
    }

    public function getUserById($id)
  	{
  		$this->db->select('id, username, name, image')
  				 ->from($this->getDataSource())
  				 ->where('id = ?');
  		$this->db->execute([$id]);
  		$this->db->setFetchModeClass(__CLASS__);
  		return $this->db->fetchAll();
  	}

    public function getUserNameById($id)
  	{
  		$this->db->select('username')
  				 ->from($this->getDataSource())
  				 ->where('id = ?');
  		$this->db->execute([$id]);
  		$username = $this->db->fetchInto($this)->getProperties()['username'];
  		return $username;
  	}

    public function getImageById($id)
  	{
  		$this->db->select('image')
  		         ->from($this->getDataSource())
  			     ->where('id = ?');
  		$this->db->execute([$id]);
  		$image = $this->db->fetchInto($this)->getProperties()['image'];
  		return $image;
  	}

    public function getTotalPosts($prefix, $sort = null, $limit = null, $id = null)
  	{
  		$params = array();
  		$sqlprep = "
  			select id,username,
  				(select count(" . $prefix . "question.userId) FROM " . $prefix . "question WHERE " . $prefix . "question.userId = " . $prefix . "user.id) AS questions,
  				(select count(" . $prefix . "answer.userId) FROM " . $prefix . "answer WHERE " . $prefix . "answer.userId = " . $prefix . "user.id) AS answers,
  				(select count(" . $prefix . "comment.userId) FROM " . $prefix . "comment WHERE " . $prefix . "comment.userId = " . $prefix . "user.id) AS comments,
  				(select (questions+answers+comments)) AS total
  			FROM " . $prefix . "user
  		";
  		if (isset($sort) && !isset($id)) {
  			$sqlprep .= " ORDER BY " . $sort;
  		}
  		if (isset($sort) && isset($limit)) {
  			$sqlprep .= " LIMIT " . $limit;
  		}
  		if (isset($id) && !isset($sort) && !isset($limit)) {
  			$sqlprep .= " WHERE id = ?";
  			$params[] = $id;
  		}
  		$sql = $sqlprep;
  		$this->db->execute($sql, $params);
  		/* $result = $this->db->fetchAll(); */
  		$this->db->setFetchModeClass(__CLASS__);
  		return $this->db->fetchAll();
  	}
}
