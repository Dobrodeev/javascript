<?php
/**
 * Copyright (C) 2015 Kuzma Feskov <kfeskov@gmail.com>
 *
 * This file may be distributed and/or modified under the terms of the
 * "GNU General Public License" version 2 as published by the Free
 * Software Foundation and appearing in the file LICENSE included in
 * the packaging of this file.
 *
 * This file is provided AS IS with NO WARRANTY OF ANY KIND, INCLUDING
 * THE WARRANTY OF DESIGN, MERCHANTABILITY AND FITNESS FOR A PARTICULAR
 * PURPOSE.
 *
 * The "GNU General Public License" (GPL) is available at
 * http:*www.gnu.org/copyleft/gpl.html.
 */

ob_start();
?>
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
    <html>
    <head>
        <title>DdTree - Subdivisions</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta name="author" content="DdTree - Subdivisions">
    </head>
    <body>
    <h2>DdTree - Subdivisions</h2>

    <?php

    require_once('../safemysql.class.php');
    require_once('../DbTree.class.php');
    require_once('../DbTreeExt.class.php');

    // Data base connect
    $dsn['user'] = 'root';
    $dsn['pass'] = '';
    $dsn['host'] = 'localhost';
    $dsn['db'] = 'sesmikcms';
    $dsn['charset'] = 'utf8';
    $dsn['errmode'] = 'exception';

    define('DEBUG_MODE', false);

    $db = new SafeMySQL($dsn);

    $sql = 'SET NAMES utf8';
    $db->query($sql);

    $tree_params = array(
        'table' => 'subdivisions',
        'id' => 'subdivision_id',
        'left' => 'subdivision_left',
        'right' => 'subdivision_right',
        'level' => 'subdivision_level'
    );

    $dbtree = new DbTreeExt($tree_params, $db);

    /* ------------------------ MOVE ------------------------ */

    /* ------------------------ MOVE 2 ------------------------ */

    // Method 2: Assigns a node with all its children to another parent.
    if (!empty($_GET['action']) && 'move_2' == $_GET['action']) {

        // Move node ($_GET['section_id']) and its children to new parent ($_POST['section2_id'])
        $dbtree->MoveAll((int)$_GET['subdivision_id'], (int)$_POST['subdivision2_id']);

        header('Location:dbtree_demo.php');
        exit;
    }

    /* ------------------------ MOVE 1 ------------------------ */

    // Method 1: Swapping nodes within the same level and limits of one parent with all its children.
    if (!empty($_GET['action']) && 'move_1' == $_GET['action']) {

        // Change node ($_GET['section_id']) position and all its childrens to
        // before or after ($_POST['position']) node 2 ($_POST['section2_id'])
        $dbtree->ChangePositionAll((int)$_GET['subdivision_id'], (int)$_POST['subdivision2_id'], $_POST['position']);

        header('Location:dbtree_demo.php');
        exit;
    }

    /* ------------------------ MOVE FORM------------------------ */

    // Move section form
    if (!empty($_GET['action']) && 'move' == $_GET['action']) {

        // Prepare the restrictive data for the first method:
        // Swapping nodes within the same level and limits of one parent with all its children
        $current_section = $dbtree->GetNode((int)$_GET['subdivision_id']);
        $parents = $dbtree->Parents((int)$_GET['subdivision_id'], array('subdivision_id'), array('and' => array('subdivision_level = ' . ($current_section['subdivision_level'] - 1))));

        $item = current($parents);
        $branch = $dbtree->Branch($item['subdivision_id'], array('subdivision_id', 'subdivision_name'), array('and' => array('subdivision_level = ' . $current_section['subdivision_level'])));

        // Create form
        ?>
        <table border="1" cellpadding="5" align="center">
            <tr>
                <td>
                    Move subdivision
                </td>
            </tr>
            <tr>
                <td>
                    <form action="dbtree_demo.php?action=move_1&subdivision_id=<?= $_GET['subdivision_id'] ?>" method="POST">
                        <strong>1) Swapping nodes within the same level and limits of one parent with all its
                            children.</strong><br>
                        Choose second subdivision:
                        <select name="subdivision2_id">
                            <?php

                            foreach($branch as $item) {

                                ?>
                                <option
                                    value="<?= $item['subdivision_id'] ?>"><?= $item['subdivision_name'] ?> <?php echo $item['subdivision_id'] == (int)$_GET['subdivision_id'] ? '<<<' : '' ?></option>
                                <?php

                            }

                            ?>
                        </select><br>
                        Choose position:
                        <select name="position">
                            <option value="after">After</option>
                            <option value="before">Before</option>
                        </select><br>
                        <center><input type="submit" value="Apply"></center>
                        <br>
                    </form>
                    <form action="dbtree_demo.php?action=move_2&subdivision_id=<?= $_GET['subdivision_id'] ?>" method="POST">
                        <strong>2) Assigns a node with all its children to another parent.</strong><br>
                        Choose second subdivision:
                        <select name="subdivision2_id">
                            <?php

                            // Prepare the data for the second method:
                            // Assigns a node with all its children to another parent
                            $full = $dbtree->Full(array('subdivision_id', 'subdivision_level', 'subdivision_name'), array('or' => array('subdivision_left <= ' . $current_section['subdivision_left'], 'subdivision_right >= ' . $current_section['subdivision_right'])));

                            foreach ($full as $item) {

                                ?>
                                <option
                                    value="<?= $item['subdivision_id'] ?>"><?= str_repeat('&nbsp;', 6 * $item['subdivision_level']) ?><?= $item['subdivision_name'] ?> <?php echo $item['subdivision_id'] == (int)$_GET['subdivision_id'] ? '<<<' : '' ?></option>
                                <?php

                            }

                            ?>
                        </select><br>
                        <center><input type="submit" value="Apply"></center>
                        <br>
                    </form>
                </td>
            </tr>
        </table>
        <?php

    }

    /* ------------------------ DELETE ------------------------ */

    // Delete node ($_GET['section_id']) from the tree wihtout deleting it's children
    // All children apps to one level
    if (!empty($_GET['action']) && 'delete' == $_GET['action']) {
        $dbtree->Delete((int)$_GET['subdivision_id']);

        header('Location:dbtree_demo.php');
        exit;
    }

    /* ------------------------ EDIT ------------------------ */

    /* ------------------------ EDIT OK ------------------------ */

    // Update node ($_GET['section_id']) info
    if (!empty($_GET['action']) && 'edit_ok' == $_GET['action']) {
        $sql = 'SELECT * FROM subdivisions WHERE subdivision_id = ' . (int)$_GET['subdivision_id'];
        $section = $db->getRow($sql);

        if (false == $section) {
            echo 'section_not_found';
            exit;
        }

        $sql = 'UPDATE subdivisions SET ?u WHERE subdivision_id = ?i';
        $db->query($sql, $_POST['subdivision'], $_GET['subdivision_id']);

        header('Location:dbtree_demo.php');
        exit;
    }

    /* ------------------------ EDIT FORM ------------------------ */

    // Node edit form
    if (!empty($_GET['action']) && 'edit' == $_GET['action']) {
        $sql = 'SELECT subdivision_name FROM subdivisions WHERE subdivision_id = ' . (int)$_GET['subdivision_id'];
        $subdivision = $db->getOne($sql);

        ?>
        <table border="1" cellpadding="5" align="center">
            <tr>
                <td>
                    Edit subdivision
                </td>
            </tr>
            <tr>
                <td align="center">
                    <form action="dbtree_demo.php?action=edit_ok&subdivision_id=<?= $_GET['subdivision_id'] ?>" method="POST">
                        Subdivision name:<br>
                        <input type="text" name="subdivision[subdivision_name]" value="<?= $subdivision ?>"><br><br>
                        <input type="submit" name="submit" value="Submit">
                    </form>
                </td>
            </tr>
        </table>
        <?php
    }

    /* ------------------------ ADD ------------------------ */

    /* ------------------------ ADD OK ------------------------ */

    // Add new node as children to selected node ($_GET['section_id'])
    if (!empty($_GET['action']) && 'add_ok' == $_GET['action']) {

        // Add new node
        $dbtree->Insert((int)$_GET['subdivision_id'], $_POST['subdivision']);

        header('Location:dbtree_demo.php');
        exit;
    }

    /* ------------------------ ADD FORM ------------------------ */

    // Add new node form
    if (!empty($_GET['action']) && 'add' == $_GET['action']) {

        ?>
        <table border="1" cellpadding="5" align="center">
            <tr>
                <td>
                    New subdivision
                </td>
            </tr>
            <tr>
                <td align="center">
                    <form action="dbtree_demo.php?action=add_ok&subdivision_id=<?= $_GET['subdivision_id'] ?>" method="POST">
                        Subdivision name:<br>
                        <input type="text" name="subdivision[subdivision_name]" value=""><br><br>
                        <input type="submit" name="submit" value="Submit">
                    </form>
                </td>
            </tr>
        </table>
        <?php

    }

    /* ------------------------ LIST ------------------------ */

    // Prepare data to view all tree
    $full = $dbtree->Full();

    ?>
    <h3>Manage tree:</h3>
    <table border="1" cellpadding="5" width="100%">
        <tr>
            <td width="100%">Subdivision name</td>
            <td colspan="4">Actions</td>
        </tr>
        <?php

        $counter = 1;
        foreach($full as $item) {
            if ($counter % 2) {
                $bgcolor = '#D8F800';
            } else {
                $bgcolor = '#FFD200';
            }
            $counter++;

            ?>
            <tr>
                <td bgcolor="<?= $bgcolor ?>">
                    <?= str_repeat('&nbsp;', 6 * $item['subdivision_level']) . '<strong>' . $item['subdivision_name'] ?></strong>
                    [<strong><?= $item['subdivision_left'] ?></strong>, <strong><?= $item['subdivision_right'] ?></strong>,
                    <strong><?= $item['subdivision_level'] ?></strong>]
                </td>
                <td bgcolor="<?= $bgcolor ?>">
                    <a href="dbtree_demo.php?action=add&subdivision_id=<?= $item['subdivision_id'] ?>">Add</a>
                </td>
                <td bgcolor="<?= $bgcolor ?>">
                    <a href="dbtree_demo.php?action=edit&subdivision_id=<?= $item['subdivision_id'] ?>">Edit</a>
                </td>
                <td bgcolor="<?= $bgcolor ?>">

                    <?php
                    if (0 == $item['subdivision_level']) {
                        echo 'Delete';
                    } else {

                        ?>
                        <a href="dbtree_demo.php?action=delete&subdivision_id=<?= $item['subdivision_id'] ?>">Delete</a>
                        <?php
                    }
                    ?>

                </td>
                <td bgcolor="<?= $bgcolor ?>">

                    <?php
                    if (0 == $item['subdivision_level']) {
                        echo 'Move';
                    } else {

                        ?>
                        <a href="dbtree_demo.php?action=move&subdivision_id=<?= $item['subdivision_id'] ?>">Move</a>
                        <?php
                    }
                    ?>

                </td>
            </tr>
            <?php
        }

        ?>
    </table>
    </body>
    </html>
<?php
ob_flush();
?>