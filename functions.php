<?

//табы: начало
add_action('woocommerce_product_tabs', function () {
    //добавить проверку наличия информации
    // Don't change content, if there is no region in URI 05.04.2018
    $region_name = get_query_var('wpc_region');
    ?>
    <div class="row tabs-area">
        <!-- Навигация -->
        <ul class="nav nav-tabs" role="tablist">
            <?php
            //                if(!isset($_COOKIE['wpc_region']) || (isset($_COOKIE['wpc_region']) && $_COOKIE['wpc_region'] === "other_city") || ! $region_name )
            //                {
            ?>
            <li class="active"><a href="#description" aria-controls="home" role="tab" data-toggle="tab">Описание</a>
            </li>
            <li><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Характеристики</a></li>
            <li><a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab">Отзывы</a></li>
            <li><a href="#prodcomments" aria-controls="prodcomments" role="tab" data-toggle="tab">Обсуждение</a></li>
            <li><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Доставка и оплата</a></li>
            <?php
            //                } else {
            ?>
            <!--                    <li class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Характеристики</a></li>
                                                <li><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Доставка и оплата</a></li>-->
            <?php
            //                }
            ?>
        </ul>
        <!-- Содержимое вкладок -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active description-tab" id="description">
                <?php
                }, 4);

                add_action('wp_head', 'wpc_woo_tabs_init');
                function wpc_woo_tabs_init()
                {
                    //коротктое описание перед длинным
                    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
                    // Don't change content, if there is no region in URI 05.04.2018
                    add_action('woocommerce_product_tabs', 'woocommerce_template_single_excerpt', 5);

                    add_action('woocommerce_product_tabs', function () {
                        if ($youtube_description = get_field('youtube_description')) {
                            echo '<div style="width: 750px; max-width: 100%; margin: 50px auto; border: 5px solid #e1e1e1;">' . render_youtube_block($youtube_description) . '</div>';
                        } else if ($youtube_review = get_field('youtube_review')) {
                            echo '<div style="width: 750px; max-width: 100%; margin: 50px auto; border: 5px solid #e1e1e1;">' . render_youtube_block($youtube_review) . '</div>';
                        }
                    }, 8);
                    // add_action('woocommerce_product_tabs', 'the_content', 9);

                    function echo_1(){
                        ob_start();
                        the_content();
                        $content = ob_get_clean();
                        $sVart   = str_replace('src="http://zzz.ru/', 'src="/', $content);
                        $sVart2  = str_replace('srcset="https://zzz/', 'srcset="/', $sVart);
                        $sVart3  = str_replace('srcset="http://zzz/', 'srcset="/', $sVart2);
                        $sVart4  = str_replace('srcset="https://zzz/', 'srcset="/', $sVart3);
                        $sVart5  = str_replace('http://zzz.ru/', 'src="/', $sVart4);
                        $sNart   = str_replace('http://', 'https://', $sVart5);


                        echo $sNart;
                    }

                    add_action( 'woocommerce_product_tabs', 'echo_1' );



                }

                //выводим снипет
                add_action('woocommerce_product_tabs', function () {
                    /*
                global $product;
                $city = get_region();
                if($city)
                {
                $region = new WP_Query( "post_type=city&meta_key=translate_city&meta_value=".$city."&order=ASC" );
                $meta_snippet_product_city = get_post_meta($region->posts[0]->ID, 'meta_snippet_product_city', true);
                }
                $post_title = str_replace('%city%', '', $product->post->post_title);

                ?>
      <div class="product_snipet">
        <h2>Преимущества покупки
          <?= $post_title ?> в интернет-магазине Онлайн-касса.ru</h2>
        <ul>
          <li>Гарантия низких цен и бесплатная доставка
            <?php if($meta_snippet_product_city) echo $meta_snippet_product_city; ?> (подробности уточняйте по
            телефону)</li>
          <li>Вы можете купить
            <?= $post_title ?> по выгодной цене с доставкой или оформить самовывоз,</li>
          <li>Полный спектр услуг связанных с подключением и обслуживанием торгового оборудования,</li>
          <li>Гарантия на все товары и отличный сервис.</li>
        </ul>
      </div>
      <?php
                 *
                 */
                }, 10);

                //табы: вкладка 2
                add_action('woocommerce_product_tabs', function () {
                // Don't change content, if there is no region in URI 05.04.2018
                $region_name = get_query_var('wpc_region');
                ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="profile">
                <?php
                global $product;
                $product->list_attributes();
                ?>
                <noindex style="color:#999;">Технические характеристики товара могут отличаться от указанных на сайте,
                    уточняйте
                    технические характеристики товара на момент покупки и оплаты. Вся
                    информация на сайте о товарах носит
                    справочный характер и не является публичной офертой в соответствии с
                    пунктом 2 статьи 437 ГК РФ. Убедительно
                    просим Вас при покупке проверять наличие желаемых функций и характеристик.
                </noindex>
            </div>
            <div role="tabpanel" class="tab-pane" id="reviews">
                <?php echo do_shortcode('[WPCR_INSERT]'); ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="prodcomments">
				<?php
                comments_template();
                ?>
            </div>
        </div> <!-- <-- без этого дива следующий блок попадает внутрь предыдущего и переключение табов не работает-->
        <div role="tabpanel" class="tab-pane" id="messages">
            <noindex>
                <?php
                }, 11);

                //табы: вкладка 3 и конец
                add_action('woocommerce_product_tabs', function () {
                //dynamic_sidebar( 'wc_prod_shipment_payment' );
                //post id 2509
                $post_dost = get_post(2509);
                $tt = apply_filters('the_content', $post_dost->post_content);
                $tt = str_replace('<h1>', '<h2>', $tt);
                $tt = str_replace('</h1>', '</h2>', $tt);
                echo $tt;

                ?>
            </noindex>
        </div>
    </div>
    </div>
    <?php
}, 11);
 
// добавляем краткое описание в начало страницы категории
add_action('woocommerce_archive_description', function () {
    global $wp_query;

//    $page = ( int ) $wp_query->get( 'page' );
//    $page2 = ( int ) $wp_query->get( 'paged' );

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    if ($paged < 2) {
        echo relink_pop_cats();
        ?>
        <div class="term-short-desc ttt">
            <?php
            //    print_r($wp_query->get_queried_object_id());
            $short_description = get_field('category_description_top', 'product_cat_' . $wp_query->get_queried_object_id());

            if ($short_description) {
                echo apply_filters('the_content', $short_description);//  do_shortcode($short_description, TRUE);
            }
            ?>
        </div>
        <?php
    }
}, 4);

// Количество товаров на странице
add_filter('loop_shop_per_page', create_function('$cols', 'return 12;'), 20);

remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
add_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 100);

//выводим тэги для категории
add_action('woocommerce_before_shop_loop', function () {
    if (is_product_category()) {
        global $wp_query;
        $shown_tags = get_field('showing_prod_tags', 'product_cat_' . $wp_query->get_queried_object_id());
        $shown_tags2 = get_field('show_tags_cats', 'product_cat_' . $wp_query->get_queried_object_id());
        if ($shown_tags || $shown_tags2) {
            echo '<div class="product-category-tags">';
            foreach ($shown_tags2 as $cat) {
                $link = get_term_link($cat->term_id, 'product_cat');
                echo "<a href=\"$link\">{$cat->name}</a> ";
            }
            foreach ($shown_tags as $tag) {
                $link = get_term_link($tag->term_id, 'product_tag');
                echo "<a href=\"$link\">{$tag->name}</a> ";
            }
            echo '</div>';
        }
    }
}, 95);
 

 

 

function render_youtube_block($url = null)
{
    if (!$url) {
        return;
    }

    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
    $youtube_id = $match[1];


    $video_id = $youtube_id;
    $api_key = 'AIzaSyAUzy42OINby2i5qs_04IlPGCZ3-fw_-wY';

    $json_result = file_get_contents ("https://www.googleapis.com/youtube/v3/videos?part=snippet&id=$video_id&key=$api_key");
    $obj = json_decode($json_result);

    $title = $obj->items[0]->snippet->title;
    $date = $obj->items[0]->snippet->publishedAt;
    $description = $obj->items[0]->snippet->description;
    $width = $obj->items[0]->snippet->thumbnails->maxres->width;
    $height = $obj->items[0]->snippet->thumbnails->maxres->height;

    $descrip =  substr($description, 0, strpos($description, ' ', 1000));

    $descrip = str_replace('"', '»', preg_replace('/((^|\s)"(\w))/um', '\2«\3', $descrip));

    $json_result2 = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id=$video_id&key=$api_key");
    $obj2 = json_decode($json_result2);

    $duration = $obj2->items[0]->contentDetails->duration;

        return "
            <div class=\"video-container\"  itemprop=\"video\" itemscope itemtype=\"https://schema.org/VideoObject\">
                <a itemprop=\"url\" href=\"https://www.youtube.com/embed/{$youtube_id}?rel=0&amp;controls=1&amp;showinfo=0&amp;autoplay=0\"></a>
                <meta itemprop=\"name\" content=\"$title;\">
                <meta itemprop=\"description\" content=\"$descrip\">
                <meta itemprop=\"duration\" content=\"$duration\">
                <link itemprop=\"image\" href=\"https://img.youtube.com/vi/{$youtube_id}/maxresdefault.jpg\">
                <meta itemprop=\"isFamilyFriendly\" content=\"True\">
                <meta itemprop=\"uploadDate\" content=\"$date\">
                <span itemprop=\"thumbnail\" itemscope itemtype=\"https://schema.org/ImageObject\">
                <link itemprop=\"contentUrl\" href=\"https://img.youtube.com/vi/{$youtube_id}/maxresdefault.jpg\">
                <meta itemprop=\"width\" content=\"$width px\">
                <meta itemprop=\"height\" content=\"$height px\">
                </span>


                <iframe id=\"youtube\" src=\"https://www.youtube.com/embed/{$youtube_id}?rel=0&amp;controls=1&amp;showinfo=0&amp;autoplay=0\" frameborder=\"0\" allowfullscreen=\"allowfullscreen\" width=\"750\" height=\"426\"></iframe>
            </div>


        ";      

}

function render_youtube_block2($url = null)
{
    if (!$url) {
        return;
    }

    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
    $youtube_id = $match[1];


    $video_id = $youtube_id;
    $api_key = 'AIzaSyAUzy42OINby2i5qs_04IlPGCZ3-fw_-wY';

    $json_result = file_get_contents ("https://www.googleapis.com/youtube/v3/videos?part=snippet&id=$video_id&key=$api_key");
    $obj = json_decode($json_result);

    $title = $obj->items[0]->snippet->title;
    $date = $obj->items[0]->snippet->publishedAt;
    $description = $obj->items[0]->snippet->description;
    $width = $obj->items[0]->snippet->thumbnails->maxres->width;
    $height = $obj->items[0]->snippet->thumbnails->maxres->height;

    $descrip =  substr($description, 0, strpos($description, ' ', 1000));

    $descrip = str_replace('"', '»', preg_replace('/((^|\s)"(\w))/um', '\2«\3', $descrip));

    $json_result2 = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id=$video_id&key=$api_key");
    $obj2 = json_decode($json_result2);

    $duration = $obj2->items[0]->contentDetails->duration;

         return'
                <div class="cat-video-banner ct-video-banner" style="height: 240px;">
                    <a href="/kupit/aekvajringom/">
                        <img src="/wp-content/themes/ok_new/img/banner-cat.png" alt="banner">
                    </a>
                </div>
                    <style> 
                        .ctg-review{
                            min-height: 240px;
                            overflow: hidden;
                            border-radius: 5px;
                            margin-bottom: 20px;
                        }
                        .ct-video-banner {
                            width: 100%;
                            height: 240px;
                            background-size: cover;
                            border-radius: 5px;
                            border-radius: 5px;
                            margin-top: 0;
                            overflow: hidden;
                            margin-bottom: 20px;
                        }
                        @media screen and ( max-width: 480px ) {
                            .wp-mobile .ct-video-banner{
                                height: auto!important;
                            }

                        }
                    </style>        
              ';
                
}

 

function get_reviews_count ($product_id) {
	return $wpdb->get_var ("SELECT COUNT(*) FROM `wp_postmeta` WHERE `meta_key` = 'wpcr3_review_post' AND meta_value = " . $product_id);
}


function get_average_rating ($product_id) {

global $wpdb; 
$query = $wpdb->prepare("
			SELECT 
			COUNT(*) AS aggregate_count, AVG(tmp2.rating) AS aggregate_rating
			FROM (
				SELECT pm4.meta_value AS rating
				FROM (
					SELECT DISTINCT pm2.post_id
					FROM {$wpdb->prefix}posts p1
					INNER JOIN {$wpdb->prefix}postmeta pm2 ON pm2.meta_key = 'wpcr3_review_post' AND pm2.meta_value = p1.id
					WHERE p1.id = %d
				) tmp1
				INNER JOIN {$wpdb->prefix}posts p2 ON p2.id = tmp1.post_id AND p2.post_status = 'publish' AND p2.post_type = 'wpcr3_review'
				INNER JOIN {$wpdb->prefix}postmeta pm4 ON pm4.post_id = p2.id AND pm4.meta_key = 'wpcr3_review_rating' AND pm4.meta_value IS NOT NULL AND pm4.meta_value != '0'
				GROUP BY p2.id
			) tmp2
		", intval($product_id));

		$results = $wpdb->get_results($query);

		if ($results) return $results[0]->aggregate_rating;
		return 0;
}