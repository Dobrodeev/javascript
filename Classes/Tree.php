<?php
/**
 * Created by PhpStorm.
 * User: Zver
 * Date: 21.07.2019
 * Time: 21:40
 */

class Tree
{
    private $pdo;

    public function __construct()
    {
        $host = '127.0.0.1';
        $db = 'regandauto';
        $user = 'root';
        $pass = '';
        $charset = 'utf8';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $this->pdo = new PDO($dsn, $user, $pass, $opt);
    }

    public function getFromTable()
    {
//        $stmt = $this->pdo->query('SELECT * FROM test_cafedra');
        $sql = 'SELECT * FROM test_cafedra';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            echo $row['name_cafedra'] . ' ' . $row['groups_cafedra'] . '<br>';
        }
    }

    public function connectDB()
    {
        /*$host = "localhost";
        //Database user name.
        $login = "root";
        //Database Password.
        $dbpass = "";
        $dbname = "abc";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];*/
//        $PDO = new PDO("mysql:host=localhost;dbname=$dbname", "$login", "$dbpass", $opt);
        $host = '127.0.0.1';
        $db = 'regandauto';
        $user = 'root';
        $pass = '';
        $charset = 'utf8';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $pdo = new PDO($dsn, $user, $pass, $opt);
        $rows = array();
        $sql = 'SELECT id, parent_id, name FROM employee';
        $query = $pdo->prepare($sql);
        $query->execute();
        $rows = array();

        if (!$query) {
            $error = 'Error fetching page structure, for nav menu generation.';
            exit();
        }

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            if (strcasecmp($row['parent_id'], 'null') === 0 || empty($row['parent_id'])) {
                $row['parent_id'] = null;
            }

            $rows[] = $row;
        }


// covert raw result set to tree
        $menu = convertAdjacencyListToTree(null, $rows, 'id', 'parent_id', 'links');
// echo '<pre>',print_r($menu),'</pre>';

// display menu
        echo themeMenu($menu, 1);
    }


    /*
    * ------------------------------------------------------------------------------------
    * Utility functions
    * ------------------------------------------------------------------------------------
    */

    /*
    * Convert adjacency list to hierarchical tree
    *
    * @param value of root level parent most likely null or 0
    * @param array result
    * @param str name of primary key column
    * @param str name of parent_id column - most likely parent_id
    * @param str name of index that children will reside ie. children, etc
    * @return array tree
    */
    public function convertAdjacencyListToTree($intParentId, &$arrRows, $strIdField, $strParentsIdField, $strNameResolution)
    {

        $arrChildren = array();

        for ($i = 0; $i < count($arrRows); $i++) {
            if ($intParentId === $arrRows[$i][$strParentsIdField]) {
                $arrChildren = array_merge($arrChildren, array_splice($arrRows, $i--, 1));
            }
        }

        $intChildren = count($arrChildren);
        if ($intChildren != 0) {
            for ($i = 0; $i < $intChildren; $i++) {
                $arrChildren[$i][$strNameResolution] = convertAdjacencyListToTree($arrChildren[$i][$strIdField], $arrRows, $strIdField, $strParentsIdField, $strNameResolution);
            }
        }

        return $arrChildren;

    }

    /*
    * Theme menu
    *
    * @param array menu
    * @param runner (depth)
    * @return str themed menu
    */
    public function themeMenu($menu, $runner)
    {

        $out = '';

        if (empty($menu)) {
            return $out;
        }

        $out .= '<ul>';
        foreach ($menu as $link) {
            $out .= sprintf(
                '<li class="depth-%u">%s%s</li>'
                , $runner
                , $link['name']
                , themeMenu($link['links'], ($runner + 1))
            );
        }

        $out .= '</ul>';
        return $out;

    }
}