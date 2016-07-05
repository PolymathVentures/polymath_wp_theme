<?php $url = isset($share_url) ? $share_url : get_the_permalink(); ?>

<p>
    <a href="#"
       target="popup"
       onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>','name','width=400,height=400')">
        <i class="si si-facebook si-small"></i>
    </a>
&nbsp;&nbsp;
    <a href="#"
       target="popup"
       onclick="window.open('https://twitter.com/home?status=<?php echo $url; ?>','name','width=400,height=400')">
        <i class="si si-twitter si-small"></i>
    </a>
&nbsp;&nbsp;
    <a href="#"
       target="popup"
       onclick="window.open('https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>','name','width=400,height=400')">
        <i class="si si-linkedin si-small"></i>
    </a>
</p>