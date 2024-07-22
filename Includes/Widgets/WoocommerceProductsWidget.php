<?php

namespace Ew_Products_Widget\Widgets;

use Ew_Products_Widget\Widgets\WoocommerceProductsWidgetBase;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class WoocommerceProductsWidget extends WoocommerceProductsWidgetBase
{
    public function get_name(): string
    {
        return 'woocommerce_products_widget';
    }

    public function get_title(): ?string
    {
        return __('نمایش محصولات ووکامرس', 'ew-products-widget');
    }

    public function get_icon(): string
    {
        return 'eicon-products';
    }

    public function get_categories(): array
    {
        return ['custom-widget-category'];
    }

    protected function _register_controls(): void
    {
        $this->start_controls_section(
            'header_section',
            [
                'label' => __('متن عنوان', 'ew-products-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'header_text',
            [
                'label' => __('عنوان', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('محصولات ویژه', 'ew-products-widget'),
            ]
        );

        $this->add_control(
            'header_alignment',
            [
                'label' => __('تراز عنوان', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('چپ', 'ew-products-widget'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('مرکز', 'ew-products-widget'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('راست', 'ew-products-widget'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('متن توضیحات', 'ew-products-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'content_text',
            [
                'label' => __('توضیحات', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('این محصولات را مشاهده کنید.', 'ew-products-widget'),
            ]
        );

        $this->add_control(
            'content_alignment',
            [
                'label' => __('تراز توضیحات', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('چپ', 'ew-products-widget'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('مرکز', 'ew-products-widget'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('راست', 'ew-products-widget'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'layout_section',
            [
                'label' => __('نمایش کارت ها', 'ew-products-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label' => __('ستون ها', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 6,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 4,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trending-product .container .row .col-lg-3.col-md-6.col-12' => 'width: calc(100% / {{SIZE}});',
                ],
            ]
        );



        $this->add_control(
            'enable_pagination',
            [
                'label' => __('گزینه صفحه بندی', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('فعال', 'ew-products-widget'),
                'label_off' => __('غیرفعال', 'ew-products-widget'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'include_exclude_section',
            [
                'label' => __('فیلتر شامل و استثنا', 'ew-products-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->start_controls_tabs('include_exclude_tabs');

        $this->start_controls_tab('include_tab', [
            'label' => __('شامل', 'ew-products-widget'),
        ]);

        $this->add_control(
            'include_authors',
            [
                'label' => __('شامل نویسندگان', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => \Ew_Products_Widget\Helpers\Functions::get_authors(),
                'multiple' => true,
                'default' => [],
            ]
        );

        $this->add_control(
            'include_conditions',
            [
                'label' => __('شامل شرایط', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('exclude_tab', [
            'label' => __('استثنا', 'ew-products-widget'),
        ]);

        $this->add_control(
            'exclude_authors',
            [
                'label' => __('استثنا نویسندگان', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => \Ew_Products_Widget\Helpers\Functions::get_authors(),
                'multiple' => true,
                'default' => [],
            ]
        );

        $this->add_control(
            'exclude_conditions',
            [
                'label' => __('استثنا شرایط', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();


        $this->start_controls_section(
            'show_section',
            [
                'label' => __('دکمه نمایش همه', 'ew-products-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_all_text',
            [
                'label' => __('متن دکمه', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('نمایش همه', 'ew-products-widget'),
            ]
        );

        $this->add_control(
            'show_all_link',
            [
                'label' => __('لینک دکمه', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('http://your-link.com', 'ew-products-widget'),
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        $this->add_control(
            'show_all_alignment',
            [
                'label' => __('تراز دکمه', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('چپ', 'ew-products-widget'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('مرکز', 'ew-products-widget'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('راست', 'ew-products-widget'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
            ]
        );

        $this->end_controls_section();

        // Query Controls
        $this->start_controls_section(
            'query_section',
            [
                'label' => __('کوئری', 'ew-products-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'product_category',
            [
                'label' => __('دسته بندی محصولات', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_product_categories(),
                'multiple' => true,
                'default' => [],
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label' => __('مرتب سازی بر اساس', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'date' => __('تاریخ', 'ew-products-widget'),
                    'price' => __('قیمت', 'ew-products-widget'),
                    'popularity' => __('محبوبیت', 'ew-products-widget'),
                    'rating' => __('امتیاز', 'ew-products-widget'),
                    'discount' => __('بیشترین تخفیف', 'ew-products-widget'),

                ],
                'default' => 'date',
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => __('جهت مرتب سازی', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'ASC' => __('صعودی', 'ew-products-widget'),
                    'DESC' => __('نزولی', 'ew-products-widget'),
                ],
                'default' => 'DESC',
            ]
        );


        $this->add_control(
            'product_count',
            [
                'label' => __( 'تعداد محصولات', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'default' => 8,
                'description' => __( ' تعداد محصولات جهت نمایش را وارد کنید', 'text-domain' ),
            ]
        );

        $this->end_controls_section();



        // Style Controls
        $this->start_controls_section(
            'style_top_title_section',
            [
                'label' => __('استایل عنوان و توضیحات بالا', 'ew-products-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Header Style
        $this->add_control(
            'header_color',
            [
                'label' => __('رنگ عنوان', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'header_typography',
                'label' => __('تایپوگرافی عنوان', 'ew-products-widget'),
                'selector' => '{{WRAPPER}} .section-title h2',
            ]
        );

        $this->add_responsive_control(
            'header_margin',
            [
                'label' => __('فاصله عنوان', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .section-title h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'header_padding',
            [
                'label' => __('پدینگ عنوان', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .section-title h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Content Style
        $this->add_control(
            'content_color',
            [
                'label' => __('رنگ توضیحات', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-description p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __('تایپوگرافی توضیحات', 'ew-products-widget'),
                'selector' => '{{WRAPPER}} .section-description p',
            ]
        );

        $this->add_responsive_control(
            'content_margin',
            [
                'label' => __('فاصله توضیحات', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .section-description p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __('پدینگ توضیحات', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .section-description p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'style_cart_section',
            [
                'label' => __('استایل کارت ها', 'ew-products-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Product Card Style
        $this->add_control(
            'product_card_background',
            [
                'label' => __('پس زمینه کارت محصول', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-product' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'product_card_shadow',
                'label' => __('سایه کارت محصول', 'ew-products-widget'),
                'selector' => '{{WRAPPER}} .single-product',
            ]
        );

        $this->add_responsive_control(
            'product_card_margin',
            [
                'label' => __('فاصله کارت محصول', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .single-product' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'product_card_padding',
            [
                'label' => __('پدینگ کارت محصول', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .single-product' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'product_card_border_radius',
            [
                'label' => __('شعاع حاشیه کارت محصول', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .single-product' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'product_card_border',
                'label' => __('حاشیه کارت محصول', 'ew-products-widget'),
                'selector' => '{{WRAPPER}} .single-product',
            ]
        );

        // Product Title Style
        $this->add_control(
            'product_title_color',
            [
                'label' => __('رنگ عنوان محصول', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .product-info .title a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'product_title_typography',
                'label' => __('تایپوگرافی عنوان محصول', 'ew-products-widget'),
                'selector' => '{{WRAPPER}} .product-info .title a',
            ]
        );

        // Product Price Style
        $this->add_control(
            'product_price_color',
            [
                'label' => __('رنگ قیمت محصول', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-Price-amount bdi, {{WRAPPER}} .woocommerce-Price-currencySymbol' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'product_price_typography',
                'label' => __('تایپوگرافی قیمت محصول', 'ew-products-widget'),
                'selector' => '{{WRAPPER}} .woocommerce-Price-amount bdi, {{WRAPPER}} .woocommerce-Price-currencySymbol',
            ]
        );

        $this->end_controls_section();

        // Button Style
        $this->start_controls_section(
            'style_button_section',
            [
                'label' => __('استایل دکمه ها', 'ew-products-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'button_color',
            [
                'label' => __('رنگ دکمه', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .button .btn' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_background',
            [
                'label' => __('پس زمینه دکمه', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .button .btn' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __('تایپوگرافی دکمه', 'ew-products-widget'),
                'selector' => '{{WRAPPER}} .button .btn',
            ]
        );

        $this->add_responsive_control(
            'button_margin',
            [
                'label' => __('فاصله دکمه', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .button .btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __('پدینگ دکمه', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .button .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => __('شعاع حاشیه دکمه', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .button .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => __('حاشیه دکمه', 'ew-products-widget'),
                'selector' => '{{WRAPPER}} .button .btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_shadow',
                'label' => __('سایه دکمه', 'ew-products-widget'),
                'selector' => '{{WRAPPER}} .button .btn',
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __('رنگ دکمه در هاور', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .button .btn:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_hover_background',
            [
                'label' => __('پس زمینه دکمه در هاور', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .button .btn:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_hover_shadow',
                'label' => __('سایه دکمه در هاور', 'ew-products-widget'),
                'selector' => '{{WRAPPER}} .button .btn:hover',
            ]
        );

        $this->end_controls_section();

        // Star Rating Style
        $this->start_controls_section(
            'style_star_section',
            [
                'label' => __('استایل بخش ستاره ها', 'ew-products-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'rating_star_color',
            [
                'label' => __('رنگ ستاره امتیاز', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .star-rating span::before' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'rating_star_background_color',
            [
                'label' => __('رنگ پس زمینه ستاره', 'ew-products-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .star-rating::before' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();




    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $args = [
            'post_type' => 'product',
            'posts_per_page' => $settings['product_count'],
            'orderby' => $settings['order_by'],
            'order' => $settings['order'],
            'tax_query' => [],
        ];

        if (!empty($settings['product_category'])) {
            $args['tax_query'][] = [
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $settings['product_category'],
            ];
        }

        if ($settings['order_by'] === 'price') {
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = '_price';
            $args['order'] = $settings['order'];
        }

        if ($settings['order_by'] === 'discount') {
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = '_sale_price';
            $args['order'] = $settings['order'];
        }

        $query = new \WP_Query($args);

        echo '<section class="trending-product section">
                    <div class="container">
                     <div class="row">
                    <div class="col-12">';
        // Display title
        if (!empty($settings['header_text'])) {
            echo '<div class="section-title"><h2 style="text-align: ' . $settings['header_alignment'] . ';">' . $settings['header_text'] . '</h2></div>';
        }

        // Display content
        if (!empty($settings['content_text'])) {
            echo '<div class="section-description"><p style="text-align: ' . $settings['content_alignment'] . ';">' . $settings['content_text'] . '</p></div>';
        }
        echo '</div></div>';

        $this->render_products($query);

        // Display "Show All" button
        if (!empty($settings['show_all_text']) && !empty($settings['show_all_link']['url'])) {
            echo '<div class="show-all button" style="text-align: ' . $settings['show_all_alignment'] . ';margin-top: 40px;">';
            echo '<a href="' . esc_url($settings['show_all_link']['url']) . '" class="btn">' . $settings['show_all_text'] . '</a>';

        }
        echo '</div></section>';
    }


}
