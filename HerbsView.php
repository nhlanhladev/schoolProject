<?php

require_once 'HerbsContr.php';

$db = new mysqli("localhost", "root", "root", "community_herb_garden");

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$model = new HerbModel($db);
$controller = new HerbController($model);
$herbs = $controller->getAllHerbs();
$householdInterests = $controller->getHouseholdInterests();
$summaryOfInterests = $controller->getSummaryOfInterests();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['add_herb'])) {
        $name = $_POST['herb_name'];
        $description = $_POST['herb_description'];
        $controller->insertHerb($name, $description);
    }

    if (isset($_POST['delete_herb'])) {
        $id = $_POST['herb_id'];
        $controller->deleteHerb($id);
    }

     if (isset($_POST['add_interest'])) {
        $household = $_POST['household_name'];
        $herbIds = array($_POST['herb1'], $_POST['herb2'], $_POST['herb3']);
        $controller->insertHouseholdInterest($household, $herbIds);
    }

    if (isset($_POST['delete_interest'])) {
        $id = $_POST['interest_id'];
        $controller->deleteHouseholdInterest($id);
    }
}

?>

<!DOCTYPE html>
<html lang="EN" xml:lang="en">

<head>
    <title>ADD</title>
</head>

<body>


    <h2>Herb Information</h2>
    <form action="" method="post">
        <label for="herb_name">Herb Name:</label>
        <input type="text" name="herb_name" required><br><br>

        <label for="herb_description">Description:</label>
        <textarea name="herb_description" required></textarea><br><br>

        <input type="submit" name="add_herb" value="Add Herb">
    </form>

    <h3>Herb List:</h3>
    <ul>
        <?php foreach ($herbs as $herb): ?>
        <li>
            <?php echo $herb['name']; ?> -
            <?php echo $herb['description']; ?>
            <form action="" method="post" style="display: inline;">
                <input type="hidden" name="herb_id" value="<?php echo $herb['id']; ?>">
                <input type="submit" name="delete_herb" value="Delete">
            </form>
        </li>
        <?php endforeach; ?>
    </ul>

    <h2>Interest in Herb Gardening</h2>
    <form action="" method="post">
        <label for="household_name">Household Name:</label>
        <input type="text" name="household_name" required><br><br>

        <label for="herb1">Choose Herb 1:</label>
        <select name="herb1">
            <?php foreach ($herbs as $herb): ?>
            <option value="<?php echo $herb['id']; ?>"><?php echo $herb['name']; ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="herb2">Choose Herb 2:</label>
        <select name="herb2">
            <?php foreach ($herbs as $herb): ?>
            <option value="<?php echo $herb['id']; ?>"><?php echo $herb['name']; ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="herb3">Choose Herb 3:</label>
        <select name="herb3">
            <?php foreach ($herbs as $herb): ?>
            <option value="<?php echo $herb['id']; ?>"><?php echo $herb['name']; ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <input type="submit" name="add_interest" value="Add Interest">
    </form>

    <h2>Summary of Interests</h2>

    <table border="1">
        <tr>
            <th>Herb</th>
            <th>Households Interested</th>
        </tr>
        <?php foreach ($summaryOfInterests as $summary): ?>

        <tr>
            <td><?php echo $summary['herb1_id']; ?></td>
            <td><?php echo $summary['interest_count']; ?></td>

        </tr>
        <?php endforeach; ?>

    </table>


</body>

</html>