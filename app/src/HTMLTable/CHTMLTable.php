<?php

namespace phes15\HTMLTable;

class CHTMLTable
{

  public $tableName;
  public $tableHeaders;
  public $tableData;

  public function __construct($tableName = null, $tableHeaders = [], $tableData = [])
  {
    $this->createTable($tableName, $tableHeaders, $tableData);
  }

  public function createTable($tableName = null, $tableHeaders = [], $tableData = [])
  {
    //Table
    $html = "<table class='" . $tableName . "'>";

    //Table headers
    if(!empty($tableHeaders)) {
      $html .= "<tr>";
      foreach ($tableHeaders as $tableHeader) {
        $html .= "<th>" . $tableHeader['label'] . "</th>";
      }
      $html .= "</tr>";
    }
    //Table data
    if(!empty($tableData)) {
      foreach ($tableData as $row) {
          $html .= "<tr>";
          foreach ($row as $value) {
            $html .= "<td>" . $value . "</td>";
          }
          $html .= "</tr>";
      }
    }

    $html .= "</table>";
    return $html;
  }
}
