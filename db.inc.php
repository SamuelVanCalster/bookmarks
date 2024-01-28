<?php

function connectToDB()
{

    try {
        $db = new PDO('mysql:host=' . DB_HOST . '; port=' . DB_PORT . '; dbname=' . DB_DB, DB_USER, DB_PASSWORD);
    } catch (PDOException $e) {
        echo "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

    return $db;
}

function getBookmarks()
{
    $sql = "select * from bookmarks where status = 1";
    $stmt = connectToDB()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function insertBookmark($title, $sitename, $description, $image, $url, $screenshot)
{
    $sql = "INSERT INTO bookmarks(title,sitename,description,image,url,screenshot) values(:title,:sitename,:description,:image,:url,:screenshot)";
    $stmt = connectToDB()->prepare($sql);
    $stmt->execute([
        "title" => $title,
        "sitename" => $sitename,
        "description" => $description,
        "image" => $image,
        "url" => $url,
        "screenshot" => $screenshot
    ]);
}

?>