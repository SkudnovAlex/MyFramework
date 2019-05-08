<h2>первая страница!</h2>
<h3><?=$name?></h3>
<h4><?=$age?></h4>
<p><?debug($names)?></p>
<?php
    foreach ($posts as $post) {
        echo "<h3>$post->title</h3>";
    }
?>