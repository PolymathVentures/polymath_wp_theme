<?php

function dependent_image_size() {

    return wp_is_mobile() ? 'medium' : 'large';

}
