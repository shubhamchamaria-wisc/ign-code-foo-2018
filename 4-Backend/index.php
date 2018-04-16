<?php
$server = "localhost";
$username = "root";
$password = "";

$con = mysqli_connect($server, $username, $password, "ign");

if (mysqli_connect_errno()) {
    printf("Connection failed: Run create.php if you haven't.");
    exit();
}

$stmt = $con->prepare("INSERT INTO content 
							(`guid`, `category`, `title`, `description`, `pubDate`, `link`, `slug`, `networks`, `state`, `tags`) 
						VALUES (?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("ssssssssss", $guid, $category, $title, $description, $pubDate, $link, $slug, $networks, $state, $tags);
$stmt2 = $con->prepare("INSERT INTO thumbnails(`guid`, `thumbnail`, `size`, `width`, `height`) VALUES(?,?,?,?,?)");
$stmt2->bind_param("sssss", $guid, $tmplink, $tmpsize, $tmpwidth, $tmpheight);
						
for($i = 1; $i <= 20; $i++)
{
	$link = sprintf("https://ign-apis.herokuapp.com/content/feed.rss?page=%s", $i);
	$xml = simplexml_load_file($link);
	foreach($xml->channel->item as $tmp)
	{
		$guid = $tmp->guid;
		$category = $tmp->category;
		$title = $tmp->title;
		$description = $tmp->description;
		$pubDate = $tmp->pubDate;
		$link = $tmp->link;
		$slug = $tmp->children('ign', true)->slug;
		$networks = $tmp->children('ign', true)->networks;
		$state = $tmp->children('ign', true)->state;
		$tags = $tmp->children('ign', true)->tags;
		foreach($tmp->children('ign', true)->thumbnail as $thumb)
		{
			$tmplink = $thumb->attributes()->link;
			$tmpsize = $thumb->attributes()->size;
			$tmpwidth = $thumb->attributes()->width;
			$tmpheight = $thumb->attributes()->height;
			$stmt2->execute();
		}
		$stmt->execute();
	}
}
echo "Success";

?>