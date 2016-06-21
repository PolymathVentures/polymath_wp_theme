<?php $url = isset($share_url) ? $share_url : get_the_permalink(); ?>

<p>
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>"
       target="popup"
       onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>','name','width=400,height=400')">
        facebook
    </a>

    <a href="https://twitter.com/home?status=<?php echo $url; ?>"
       target="popup"
       onclick="window.open('https://twitter.com/home?status=<?php echo $url; ?>','name','width=400,height=400')">
        twitter
    </a>

    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>"
       target="popup"
       onclick="window.open('https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>','name','width=400,height=400')">
        LinkedIn
    </a>
</p>