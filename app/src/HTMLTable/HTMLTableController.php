<?php

namespace phes15\HTMLTable;

class HTMLTableController implements \Anax\DI\IInjectionAware
{
  use \Anax\DI\TInjectable;

  public function initialize()
  {
      $this->tables = new \phes15\HTMLTable\HTMLTable();
      $this->tables->setDI($this->di);
  }

  public function indexAction()
  {
      $fetchedStatement = $this->tables->query('name, age, email')
                        ->execute();

      $this->theme->setTitle('View table');

      $table1 = $this->di->table->createTable(

        //Table name
        "testTable",

        //Table headers
        [
          [
            'label' => 'Name',
          ],
          [
            'label' => 'Age',
          ],
          [
            'label' => 'Email',
          ],
        ],

        //Table data
        $fetchedStatement
      );

      $table2 = $this->di->table->createTable(

      "testTable",

      [
        [
          'label' => 'Name',
        ],
        [
          'label' => 'Age',
        ],
        [
          'label' => 'Email',
        ],
      ],

      [
        [
          'name' => 'Philip Esmailzade',
          'age' => '19',
          'email' => 'paikzswe@gmail.com',
        ],

        [
          'name' => 'test',
          'age' => '99',
          'email' => 'test@test.com',
        ],
      ]

    );

      $this->di->views->add('HTMLTable/page', [
          'title' => "HTMLTable test",
          'table1' => $table1,
          'table2' => $table2
      ]);
  }

  public function setupAction()
  {
    $this->theme->setTitle('Reset database');
    $this->db->dropTableIfExists('htmltable')->execute();

    $this->db->createTable(
          'htmltable',
          [
              'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
              'name' => ['varchar(80)'],
              'age' => ['varchar(80)'],
              'email' => ['varchar(80)'],
          ]
      )->execute();

      $this->db->insert(
            'htmltable',
            ['name', 'age', 'email']
            );

    $now = gmdate('Y-m-d H:i:s');
    $this->db->execute([
          'Philip Esmailzade',
          '19',
          'admin@mail.se',
      ]);

      $this->db->execute([
          'Test',
          '99',
          'random@mail.com',
      ]);
  }

}
