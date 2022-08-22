<?php

function head_code()
{
    if (ads('head_code') && subscription()->plan->advertisements) {
        return ads('head_code')->code;
    }
}

function ads_home_page_top()
{
    if (ads('home_page_top') && subscription()->plan->advertisements) {
        return '<center>
           <div class="vr-adv-unit vr-adv-unit-728x90 mt-80 mb-40">' . ads('home_page_top')->code . '</div>
        </center>';
    }
}

function ads_home_page_bottom()
{
    if (ads('home_page_bottom') && subscription()->plan->advertisements) {
        return '<center>
           <div class="vr-adv-unit vr-adv-unit-728x90 mb-80 mt-40">' . ads('home_page_bottom')->code . '</div>
        </center>';
    }
}

function ads_download_page_header()
{
    if (ads('download_page_header') && subscription()->plan->advertisements) {
        return '<center>
           <div class="vr-adv-unit vr-adv-unit-728x90 download-page-header-ad">' . ads('download_page_header')->code . '</div>
        </center>';
    }
}

function ads_download_page_left_sidebar_top()
{
    if (ads('download_page_left_sidebar_top') && subscription()->plan->advertisements) {
        return '<center>
           <div class="vr-adv-unit vr-adv-unit-300x280 mb-3 mobile-hide">' . ads('download_page_left_sidebar_top')->code . '</div>
        </center>';
    }
}

function ads_download_page_left_sidebar_bottom()
{
    if (ads('download_page_left_sidebar_bottom') && subscription()->plan->advertisements) {
        return '<center>
           <div class="vr-adv-unit vr-adv-unit-300x280">' . ads('download_page_left_sidebar_bottom')->code . '</div>
        </center>';
    }
}

function ads_download_page_description()
{
    if (ads('download_page_description') && subscription()->plan->advertisements) {
        return '<center>
           <div class="vr-adv-unit vr-adv-unit-200x355 mobile-hide">' . ads('download_page_description')->code . '</div>
        </center>';
    }
}

function ads_download_page_down_bottom()
{
    if (ads('download_page_down_bottom') && subscription()->plan->advertisements) {
        return '<center>
           <div class="vr-adv-unit vr-adv-unit-728x90 mb-5">' . ads('download_page_down_bottom')->code . '</div>
        </center>';
    }
}

function ads_blog_page_center()
{
    if (ads('blog_page_center') && subscription()->plan->advertisements) {
        return '<center>
           <div class="vr-adv-unit vr-adv-unit-728x90 my-4">' . ads('blog_page_center')->code . '</div>
        </center>';
    }
}

function ads_blog_page_bottom()
{
    if (ads('blog_page_bottom') && subscription()->plan->advertisements) {
        return '<center>
           <div class="vr-adv-unit vr-adv-unit-728x90 mobile-hide mb-80">' . ads('blog_page_bottom')->code . '</div>
        </center>';
    }
}

function ads_blog_page_sidebar_top()
{
    if (ads('blog_page_sidebar_top') && subscription()->plan->advertisements) {
        return '<center>
           <div class="vr-adv-unit vr-adv-unit-300x280 my-4">' . ads('blog_page_sidebar_top')->code . '</div>
        </center>';
    }
}

function ads_blog_page_sidebar_bottom()
{
    if (ads('blog_page_sidebar_bottom') && subscription()->plan->advertisements) {
        return '<center>
           <div class="vr-adv-unit vr-adv-unit-300x280 my-4">' . ads('blog_page_sidebar_bottom')->code . '</div>
        </center>';
    }
}

function ads_blog_page_article_top()
{
    if (ads('blog_page_article_top') && subscription()->plan->advertisements) {
        return '<center>
           <div class="vr-adv-unit vr-adv-unit-728x90 my-4">' . ads('blog_page_article_top')->code . '</div>
        </center>';
    }
}

function ads_blog_page_article_Bottom()
{
    if (ads('blog_page_article_Bottom') && subscription()->plan->advertisements) {
        return '<center>
           <div class="vr-adv-unit vr-adv-unit-728x90 my-4">' . ads('blog_page_article_Bottom')->code . '</div>
        </center>';
    }
}
