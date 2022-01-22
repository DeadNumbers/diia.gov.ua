<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* /var/www/sitefiles/themes/diia/pages/post.htm */
class __TwigTemplate_5c389f3667bc55a01e2512cb8570a81c57454c5336a2f418d23efb7217467922 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        $context["post"] = twig_get_attribute($this->env, $this->source, ($context["blogPost"] ?? null), "post", [], "any", false, false, false, 1);
        // line 2
        $context["nextPost"] = twig_get_attribute($this->env, $this->source, ($context["post"] ?? null), "getNext", [], "method", false, false, false, 2);
        // line 3
        $context["prevPost"] = twig_get_attribute($this->env, $this->source, ($context["post"] ?? null), "getPrev", [], "method", false, false, false, 3);
        // line 4
        echo "
";
        // line 5
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/breadcrumbs"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 6
        echo "
<!-- news post -->
<section>
    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-12\">
                <div class=\"page_title\">
                    <div class=\"page_title-text\">";
        // line 13
        echo twig_get_attribute($this->env, $this->source, ($context["post"] ?? null), "title", [], "any", false, false, false, 13);
        echo "</div>
                    <div class=\"page_title-date\">";
        // line 14
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["post"] ?? null), "published_at", [], "any", false, false, false, 14), "d/m/Y"), "html", null, true);
        echo "</div>
                </div>
            </div>
        </div>
        <div class=\"row justify-content-lg-between\">
            <div class=\"col-lg-8\">
                <div class=\"editor-content ";
        // line 20
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, false, 20), "editorContentClass", [], "any", false, false, false, 20), "html", null, true);
        echo "\">
                    ";
        // line 21
        if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["blogPost"] ?? null), "post", [], "any", false, false, false, 21), "featured_images", [], "any", false, false, false, 21)) == 1)) {
            // line 22
            echo "                        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["blogPost"] ?? null), "post", [], "any", false, false, false, 22), "featured_images", [], "any", false, false, false, 22));
            foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
                // line 23
                echo "                            <img src=\"";
                echo KitSoft\Resizer\Twig\Filters::resize(twig_get_attribute($this->env, $this->source, $context["image"], "path", [], "any", false, false, false, 23), 730, 410);
                echo "\"  alt=\"";
                echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->source, $context["image"], "description", [], "any", false, false, false, 23)) ? (twig_get_attribute($this->env, $this->source, $context["image"], "description", [], "any", false, false, false, 23)) : (twig_get_attribute($this->env, $this->source, ($context["post"] ?? null), "title", [], "any", false, false, false, 23))), "html", null, true);
                echo "\"  title=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["image"], "description", [], "any", false, false, false, 23), "html", null, true);
                echo "\" class=\"img-fluid\">
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['image'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 25
            echo "                    ";
        }
        // line 26
        echo "                    ";
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["post"] ?? null), "excerpt", [], "any", false, false, false, 26))) {
            // line 27
            echo "                    <div class=\"page_title-excerpt\">
                        ";
            // line 28
            echo twig_get_attribute($this->env, $this->source, ($context["post"] ?? null), "excerpt", [], "any", false, false, false, 28);
            echo "
                    </div>
                    ";
        }
        // line 31
        echo "                    ";
        echo twig_get_attribute($this->env, $this->source, ($context["post"] ?? null), "content", [], "any", false, false, false, 31);
        echo "
                    ";
        // line 32
        if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["blogPost"] ?? null), "post", [], "any", false, false, false, 32), "featured_images", [], "any", false, false, false, 32)) > 1)) {
            // line 33
            echo "                        ";
            // line 34
            echo "                        <div class=\"swiper_news-box\">
                            <div class=\"swiper-container swiper_news js-swiper_news\">
                                <div class=\"swiper-wrapper swiper_news-wrapper\">
                                    ";
            // line 37
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["blogPost"] ?? null), "post", [], "any", false, false, false, 37), "featured_images", [], "any", false, false, false, 37));
            foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
                // line 38
                echo "                                    <div class=\"swiper-slide swiper_news-slide\"  title=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["image"], "description", [], "any", false, false, false, 38), "html", null, true);
                echo "\" datasize=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["image"], "file_size", [], "any", false, false, false, 38), "html", null, true);
                echo "\" srcOrigin=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["image"], "path", [], "any", false, false, false, 38), "html", null, true);
                echo "\" href=\"";
                echo KitSoft\Resizer\Twig\Filters::resize(twig_get_attribute($this->env, $this->source, $context["image"], "path", [], "any", false, false, false, 38), 820, 360);
                echo "\" style=\"background-image: url('";
                echo KitSoft\Resizer\Twig\Filters::resize(twig_get_attribute($this->env, $this->source, $context["image"], "path", [], "any", false, false, false, 38), 730, 410);
                echo "')\">
                                        ";
                // line 45
                echo "                                    </div>
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['image'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 47
            echo "                                </div>
                            </div>
                            <div class=\"swiper_news-nav\">
                                <div class=\"swiper_news-btn-prev\"></div>
                                <div class=\"swiper-container swiper_news-thumbs js-swiper_news-thumbs\">
                                    <div class=\"swiper-wrapper swiper_news-thumbs-wrapper\">
                                        ";
            // line 53
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["blogPost"] ?? null), "post", [], "any", false, false, false, 53), "featured_images", [], "any", false, false, false, 53));
            foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
                // line 54
                echo "                                        <div class=\"swiper-slide swiper_news-thumbs-slide\" style=\"background-image: url('";
                echo KitSoft\Resizer\Twig\Filters::resize(twig_get_attribute($this->env, $this->source, $context["image"], "path", [], "any", false, false, false, 54), 140, 80);
                echo "');\"></div>
                                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['image'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 56
            echo "                                    </div>
                                </div>
                                <div class=\"swiper_news-btn-next\"></div>
                            </div>
                        </div>
                    ";
        }
        // line 62
        echo "                </div>
            </div>
            <div class=\"d-none d-lg-block col-lg-3\">
                <div class=\"btn-action_wrap\">
                    <div class=\"btn-action_title\">";
        // line 66
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Поділитись новиною"]);
        echo "</div>
                    <div class=\"btn-action_box\">
                        <div class=\"btn btn-action btn-action_fb\" tabindex=\"0\" role=\"button\" aria-pressed=\"false\" data-type=\"facebook\"></div>
                        <div class=\"btn btn-action btn-action_tw\" tabindex=\"0\" role=\"button\" aria-pressed=\"false\" data-type=\"twitter\"></div>
                        <div class=\"btn btn-action btn-action-tel d-none\" tabindex=\"0\" role=\"button\" aria-pressed=\"false\" data-type=\"telegram\"></div>
                    </div>
                </div>
                <!-- sidebar -->
\t\t\t\t";
        // line 74
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["blogPost"] ?? null), "relatedPosts", [], "any", false, false, false, 74))) {
            // line 75
            echo "\t\t\t\t\t<div class=\"sidebar\">
\t\t\t\t\t    <div class=\"sidebar_title\">";
            // line 76
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Інші новини"]);
            echo "</div>
                        ";
            // line 77
            if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["blogPost"] ?? null), "relatedPosts", [], "any", false, false, false, 77))) {
                // line 78
                echo "                            <div class=\"sidebar-list\">
                                ";
                // line 79
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["blogPost"] ?? null), "relatedPosts", [], "any", false, false, false, 79));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 80
                    echo "                                <div class=\"sidebar-list_item\">
                                    <div class=\"sidebar-list_item-date\">
                                        ";
                    // line 82
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "published_at", [], "any", false, false, false, 82), "d/m/Y"), "html", null, true);
                    echo "
                                    </div>
                                    <a href=\"";
                    // line 84
                    echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 84));
                    echo "\" class=\"sidebar-list_item-title\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 84), "html", null, true);
                    echo "</a>
                                </div>
                                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 87
                echo "                            </div>
                        ";
            }
            // line 89
            echo "\t\t\t\t\t</div>
\t\t\t\t";
        }
        // line 91
        echo "\t\t\t\t<!-- /sidebar -->
            </div>
        </div>
</section>

";
        // line 96
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["newsLast"] ?? null), "posts", [], "any", false, false, false, 96))) {
            // line 97
            echo "    <section class=\"last-item_news-section\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-lg-6\">
                    <h1 class=\"article-level-1\">";
            // line 101
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Останні новини"]);
            echo "</h1>
                </div>
            </div>
            <div class=\"row\">
                <div class=\"col-md-6\">
                    ";
            // line 106
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_slice($this->env, twig_get_attribute($this->env, $this->source, ($context["newsLast"] ?? null), "posts", [], "any", false, false, false, 106), 0, 1));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 107
                echo "                    <div class=\"last-item_news-top\">
                        ";
                // line 108
                if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "featured_images", [], "any", false, false, false, 108))) {
                    // line 109
                    echo "                            <div class=\"last-item_news-preview\" style=\"background-image: url('";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_first($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "featured_images", [], "any", false, false, false, 109)), "path", [], "any", false, false, false, 109), "html", null, true);
                    echo "')\">
                            </div>
                        ";
                } else {
                    // line 112
                    echo "                            <div class=\"last-item_news-preview\" style=\"background-image: url('";
                    echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/posts_item-preview.svg");
                    echo "');\">
                            </div>
                        ";
                }
                // line 115
                echo "                        <div class=\"last-item_news-content\">
                            ";
                // line 116
                if (twig_get_attribute($this->env, $this->source, $context["item"], "published_at", [], "any", false, false, false, 116)) {
                    // line 117
                    echo "                            <div class=\"last-item_news-content-date\">
                                ";
                    // line 118
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "published_at", [], "any", false, false, false, 118), "d/m/Y"), "html", null, true);
                    echo "
                            </div>
                            ";
                } else {
                    // line 121
                    echo "                            <div class=\"last-item_news-content-date\">
                                ";
                    // line 122
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "created_at", [], "any", false, false, false, 122), "d/m/Y"), "html", null, true);
                    echo "
                            </div>
                            ";
                }
                // line 125
                echo "                            <a href=\"";
                echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 125));
                echo "\" class=\"last-item_news-content-title\">
                                ";
                // line 126
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 126), "html", null, true);
                echo "
                            </a>
                        </div>
                    </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 131
            echo "                </div>
                <div class=\"col-md-6\">
                    <div class=\"row\">
                        ";
            // line 134
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_slice($this->env, twig_get_attribute($this->env, $this->source, ($context["newsLast"] ?? null), "posts", [], "any", false, false, false, 134), 1, 5));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 135
                echo "                        <div class=\"col-6\">
                            <div class=\"last-item\">
                                <div class=\"last-item_content\">
                                    ";
                // line 138
                if (twig_get_attribute($this->env, $this->source, $context["item"], "published_at", [], "any", false, false, false, 138)) {
                    // line 139
                    echo "                                    <div class=\"last-item_content-date\">
                                        ";
                    // line 140
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "published_at", [], "any", false, false, false, 140), "d/m/Y"), "html", null, true);
                    echo "
                                    </div>
                                    ";
                } else {
                    // line 143
                    echo "                                    <div class=\"last-item_content-date\">
                                        ";
                    // line 144
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "created_at", [], "any", false, false, false, 144), "d/m/Y"), "html", null, true);
                    echo "
                                    </div>
                                    ";
                }
                // line 147
                echo "                                    <a href=\"";
                echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 147));
                echo "\" class=\"last-item_content-title\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 147), "html", null, true);
                echo "</a>
                                </div>
                            </div>
                        </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 152
            echo "                    </div>
                </div>
            </div>
        </div>
    </section>
";
        }
        // line 158
        echo "
";
        // line 159
        echo $this->env->getExtension('Cms\Twig\Extension')->startBlock('scripts'        );
        // line 160
        echo "    <script type=\"text/javascript\" src=\"";
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/javascript/build/post.bundle.js");
        echo "\"></script>
";
        // line 159
        echo $this->env->getExtension('Cms\Twig\Extension')->endBlock(true        );
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/pages/post.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  392 => 159,  387 => 160,  385 => 159,  382 => 158,  374 => 152,  360 => 147,  354 => 144,  351 => 143,  345 => 140,  342 => 139,  340 => 138,  335 => 135,  331 => 134,  326 => 131,  315 => 126,  310 => 125,  304 => 122,  301 => 121,  295 => 118,  292 => 117,  290 => 116,  287 => 115,  280 => 112,  273 => 109,  271 => 108,  268 => 107,  264 => 106,  256 => 101,  250 => 97,  248 => 96,  241 => 91,  237 => 89,  233 => 87,  222 => 84,  217 => 82,  213 => 80,  209 => 79,  206 => 78,  204 => 77,  200 => 76,  197 => 75,  195 => 74,  184 => 66,  178 => 62,  170 => 56,  161 => 54,  157 => 53,  149 => 47,  142 => 45,  129 => 38,  125 => 37,  120 => 34,  118 => 33,  116 => 32,  111 => 31,  105 => 28,  102 => 27,  99 => 26,  96 => 25,  83 => 23,  78 => 22,  76 => 21,  72 => 20,  63 => 14,  59 => 13,  50 => 6,  46 => 5,  43 => 4,  41 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/pages/post.htm", "");
    }
}
