<?php

namespace Ew_Products_Widget\Widgets;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

abstract class WoocommerceProductsWidgetBase extends \Elementor\Widget_Base
{
    protected function get_product_categories(): array
    {
        $terms = get_terms('product_cat', ['hide_empty' => true]);
        $categories = [];
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $categories[$term->slug] = $term->name;
            }
        }
        return $categories;
    }

    protected function render_products($query): void
    {
        if ($query->have_posts()) {
            echo '<div class="row">';
            while ($query->have_posts()) {
                $query->the_post();
                global $product;
                $average_rating = $product->get_average_rating();
                $rating_percentage = ($average_rating / 5) * 100;


                if ($product->is_on_sale()) {
                    $regular_price = $product->get_regular_price();
                    $sale_price = $product->get_sale_price();
                    $discount_percentage =  round((($regular_price - $sale_price) / $regular_price) * 100) . '%';
                }
                ?>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-product">
                        <div class="product-image">
                            <?php if ($product->is_on_sale()) : ?>
                                <div class="discount-tag"><?php echo $discount_percentage; ?></div>
                            <?php endif; ?>
                            <a href="<?php echo get_permalink(); ?>">
                                <?php echo woocommerce_get_product_thumbnail(); ?>
                            </a>
                            <div class="button">
                                <a href="<?php echo esc_url($product->add_to_cart_url()); ?>" class="btn"><i class="lni lni-cart"></i> <?php echo esc_html($product->add_to_cart_text()); ?></a>
                            </div>
                        </div>
                        <div class="product-info">
                            <span class="category"><?php echo wc_get_product_category_list($product->get_id()); ?></span>
                            <h4 class="title"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
                            <ul class="review">
                                <div class="star-rating">
                                    <span style="width: <?php echo $rating_percentage; ?>%;"></span>
                                </div>
                                <li><span><?php echo $product->get_review_count(); ?> امتیاز </span></li>
                            </ul>
                            <div class="price">
                                <?php echo $product->get_price_html(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            echo '</div></div>';
        } else {
            echo __('محصولی یافت نشد', 'ew-products-widget');
        }
        wp_reset_postdata();
    }
}
