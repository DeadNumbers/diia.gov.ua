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

/* /var/www/sitefiles/themes/diia/partials/site/sections/servicesCategories.htm */
class __TwigTemplate_9b8c6011c8103eef0503722e20177152f0e73f6ca1325e222a5433a3ee9a5cef extends \Twig\Template
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
        if ((($context["data"] ?? null) && twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["servicesCategories"] ?? null), "categories", [], "any", false, false, false, 1)))) {
            // line 2
            echo "<section class=\"services_section\">
    <ul class=\"nav nav-tabs tabs_services\" role=\"tablist\">
        ";
            // line 4
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["servicesCategories"] ?? null), "categories", [], "any", false, false, false, 4));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
                if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["category"], "services", [], "any", false, false, false, 4))) {
                    // line 5
                    echo "        <li class=\"nav-item\">
            <a class=\"nav-link ";
                    // line 6
                    if (twig_get_attribute($this->env, $this->source, $context["loop"], "first", [], "any", false, false, false, 6)) {
                        echo "active";
                    }
                    echo "\" id=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["category"], "slug", [], "any", false, false, false, 6), "html", null, true);
                    echo "-tab\" data-toggle=\"tab\" href=\"#";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["category"], "slug", [], "any", false, false, false, 6), "html", null, true);
                    echo "\" role=\"tab\" aria-controls=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["category"], "slug", [], "any", false, false, false, 6), "html", null, true);
                    echo "\" aria-selected=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["loop"], "first", [], "any", false, false, false, 6), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 6), "html", null, true);
                    echo "</a>
        </li>
        ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 9
            echo "    </ul>
    <div class=\"tab-content tab-content_slider\">
        ";
            // line 11
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["servicesCategories"] ?? null), "categories", [], "any", false, false, false, 11));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
                if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["category"], "services", [], "any", false, false, false, 11))) {
                    // line 12
                    echo "        <div class=\"tab-pane fade ";
                    if (twig_get_attribute($this->env, $this->source, $context["loop"], "first", [], "any", false, false, false, 12)) {
                        echo "show active";
                    }
                    echo "\" id=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["category"], "slug", [], "any", false, false, false, 12), "html", null, true);
                    echo "\" role=\"tabpanel\" aria-labelledby=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["category"], "slug", [], "any", false, false, false, 12), "html", null, true);
                    echo "-tab\">
            <div class=\"swiper_services-box\">
                <div class=\"swiper_services swiper-container js-swiper_services\">
                    <div class=\"swiper_services-top\">
                        <div class=\"swiper_services-title\">";
                    // line 16
                    echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Популярні послуги"]);
                    echo "</div>
                        <div class=\"swiper_services-btn-box\">
                            <div class=\"swiper_services-btn-prev swiper-btn-prev\"></div>
                            <div class=\"swiper_services-btn-next swiper-btn-next\"></div>
                        </div>
                    </div>
                    <div class=\"swiper-wrapper swiper_services-wrapper\">
                        ";
                    // line 23
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["category"], "services", [], "any", false, false, false, 23));
                    foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                        // line 24
                        echo "                        <div class=\"swiper-slide swiper_services-slide\">
                            <div class=\"swiper_services-slide-hover\">
                                ";
                        // line 26
                        if (twig_get_attribute($this->env, $this->source, $context["item"], "image", [], "any", false, false, false, 26)) {
                            // line 27
                            echo "                                    <a href=\"";
                            echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 27));
                            echo "\" class=\"swiper_services-slide-image\" style=\"background-image: url('";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "image", [], "any", false, false, false, 27), "path", [], "any", false, false, false, 27), "html", null, true);
                            echo "');\"></a>
                                ";
                        } else {
                            // line 29
                            echo "                                    <a href=\"";
                            echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 29));
                            echo "\" class=\"swiper_services-slide-image\" style=\"background-image: url('";
                            echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/posts_item-preview.svg");
                            echo "');\"></a>
                                ";
                        }
                        // line 31
                        echo "                                ";
                        if (twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 31)) {
                            // line 32
                            echo "                                    <div class=\"swiper_services-slide-content\">
                                        <a href=\"";
                            // line 33
                            echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 33));
                            echo "\" class=\"swiper_services-slide-title\">";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 33), "html", null, true);
                            echo "</a>
                                    </div>
                                ";
                        }
                        // line 36
                        echo "                            </div>
                            <div class=\"swiper_services-slide-content\">
                                ";
                        // line 38
                        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "fields", [], "any", false, false, false, 38), "client_time", [], "any", false, false, false, 38) || twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "fields", [], "any", false, false, false, 38), "register_time", [], "any", false, false, false, 38))) {
                            // line 39
                            echo "                                <div class=\"swiper_services-slide-about\">
                                    ";
                            // line 40
                            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "fields", [], "any", false, false, false, 40), "client_time", [], "any", false, false, false, 40)) {
                                // line 41
                                echo "                                    <div class=\"swiper_services-slide-short\">
                                        <span>";
                                // line 42
                                echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Вашого часу"]);
                                echo ":</span><span> ";
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "fields", [], "any", false, false, false, 42), "client_time", [], "any", false, false, false, 42), "html", null, true);
                                echo "</span>
                                    </div>
                                    ";
                            }
                            // line 45
                            echo "                                    ";
                            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "fields", [], "any", false, false, false, 45), "register_time", [], "any", false, false, false, 45)) {
                                // line 46
                                echo "                                    <div class=\"swiper_services-slide-short\">
                                        <span>";
                                // line 47
                                echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Реєстрація"]);
                                echo ":</span><span> ";
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "fields", [], "any", false, false, false, 47), "register_time", [], "any", false, false, false, 47), "html", null, true);
                                echo "</span>
                                    </div>
                                    ";
                            }
                            // line 50
                            echo "                                </div>
                                ";
                        }
                        // line 52
                        echo "                                ";
                        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "fields", [], "any", false, false, false, 52), "link_description", [], "any", false, false, false, 52)) {
                            // line 53
                            echo "                                    <div class=\"swiper_services-slide-info\">";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "fields", [], "any", false, false, false, 53), "link_description", [], "any", false, false, false, 53), "html", null, true);
                            echo "</div>
                                ";
                        }
                        // line 55
                        echo "                            </div>
                        </div>
                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 58
                    echo "                    </div>
                    <div class=\"swiper-pagination swiper_services-pagination\"></div>
                </div>
            </div>
            <!-- services_section -->
            <div class=\"services_section-item\">
                <div class=\"container\">
                    <div class=\"row\">
                        <div class=\"col-12 col-lg-8\">
                            <div class=\"row\">
                                ";
                    // line 68
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_slice($this->env, twig_get_attribute($this->env, $this->source, $context["category"], "subcategories_tree", [], "any", false, false, false, 68), 0, 4));
                    foreach ($context['_seq'] as $context["_key"] => $context["subcategory"]) {
                        // line 69
                        echo "                                <div class=\"col-6\">
                                    <div class=\"services_item\">
                                        ";
                        // line 71
                        if (twig_get_attribute($this->env, $this->source, $context["subcategory"], "name", [], "any", false, false, false, 71)) {
                            // line 72
                            echo "                                        <a href=\"";
                            echo KitSoft\Core\Twig\UrlFilter::url(((twig_get_attribute($this->env, $this->source, $context["category"], "url", [], "any", false, false, false, 72) . "/") . twig_get_attribute($this->env, $this->source, $context["subcategory"], "slug", [], "any", false, false, false, 72)));
                            echo "\" class=\"services_item-title\">";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["subcategory"], "name", [], "any", false, false, false, 72), "html", null, true);
                            echo "</a>
                                        ";
                        }
                        // line 74
                        echo "                                        ";
                        if (twig_get_attribute($this->env, $this->source, $context["subcategory"], "description", [], "any", false, false, false, 74)) {
                            // line 75
                            echo "                                        <div class=\"services_item-info\">";
                            echo twig_get_attribute($this->env, $this->source, $context["subcategory"], "description", [], "any", false, false, false, 75);
                            echo "</div>
                                        ";
                        }
                        // line 77
                        echo "                                    </div>
                                </div>
                                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['subcategory'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 80
                    echo "                            </div>
                        </div>
                        <div class=\"col-6 col-lg-4 d-none d-lg-block\">
                            ";
                    // line 83
                    if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "widget", [], "any", false, false, false, 83), "title", [], "any", false, false, false, 83)) {
                        // line 84
                        echo "                            <div class=\"services_item-white\">
                                ";
                        // line 85
                        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "widget", [], "any", false, false, false, 85), "title", [], "any", false, false, false, 85)) {
                            // line 86
                            echo "                                <div class=\"services_item-lead\">";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "widget", [], "any", false, false, false, 86), "title", [], "any", false, false, false, 86), "html", null, true);
                            echo "</div>
                                ";
                        }
                        // line 88
                        echo "                                ";
                        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "widget", [], "any", false, false, false, 88), "text", [], "any", false, false, false, 88)) {
                            // line 89
                            echo "                                <div class=\"services_item-info services_item-info-m\">";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "widget", [], "any", false, false, false, 89), "text", [], "any", false, false, false, 89), "html", null, true);
                            echo "</div>
                                ";
                        }
                        // line 91
                        echo "                                ";
                        if (twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "widget", [], "any", false, false, false, 91), "link", [], "any", false, false, false, 91)), "title", [], "any", false, false, false, 91)) {
                            // line 92
                            echo "                                <a href=\"";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "widget", [], "any", false, false, false, 92), "link", [], "any", false, false, false, 92)), "url", [], "any", false, false, false, 92), "html", null, true);
                            echo "\" ";
                            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "widget", [], "any", false, false, false, 92), "link", [], "any", false, false, false, 92), "target", [], "any", false, false, false, 92)) {
                                echo "target=\"_blank\" ";
                            }
                            echo " class=\"btn btn-fill\">
                                    ";
                            // line 93
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "widget", [], "any", false, false, false, 93), "link", [], "any", false, false, false, 93)), "title", [], "any", false, false, false, 93), "html", null, true);
                            echo "
                                </a>
                                ";
                        }
                        // line 96
                        echo "                            </div>
                            ";
                    }
                    // line 98
                    echo "                        </div>
                    </div>
                    <div class=\"row\">
                        ";
                    // line 101
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_slice($this->env, twig_get_attribute($this->env, $this->source, $context["category"], "subcategories_tree", [], "any", false, false, false, 101), 4));
                    foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                        // line 102
                        echo "                        <div class=\"col-6 col-lg-4\">
                            <div class=\"services_item\">
                                ";
                        // line 104
                        if (twig_get_attribute($this->env, $this->source, $context["item"], "name", [], "any", false, false, false, 104)) {
                            // line 105
                            echo "                                <a href=\"";
                            echo KitSoft\Core\Twig\UrlFilter::url(((twig_get_attribute($this->env, $this->source, $context["category"], "url", [], "any", false, false, false, 105) . "/") . twig_get_attribute($this->env, $this->source, $context["item"], "slug", [], "any", false, false, false, 105)));
                            echo "\" class=\"services_item-title\">";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "name", [], "any", false, false, false, 105), "html", null, true);
                            echo "</a>
                                ";
                        }
                        // line 107
                        echo "                                ";
                        if (twig_get_attribute($this->env, $this->source, $context["item"], "description", [], "any", false, false, false, 107)) {
                            // line 108
                            echo "                                <div class=\"services_item-info\">";
                            echo twig_get_attribute($this->env, $this->source, $context["item"], "description", [], "any", false, false, false, 108);
                            echo "</div>
                                ";
                        }
                        // line 110
                        echo "                            </div>
                        </div>
                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 113
                    echo "                        <div class=\"col-12 d-lg-none text-center\">
                            ";
                    // line 114
                    if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "widget", [], "any", false, false, false, 114), "title", [], "any", false, false, false, 114)) {
                        // line 115
                        echo "                            <div class=\"services_item-white\">
                                ";
                        // line 116
                        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "widget", [], "any", false, false, false, 116), "title", [], "any", false, false, false, 116)) {
                            // line 117
                            echo "                                <div class=\"services_item-lead\">";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "widget", [], "any", false, false, false, 117), "title", [], "any", false, false, false, 117), "html", null, true);
                            echo "</div>
                                ";
                        }
                        // line 119
                        echo "                                ";
                        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "widget", [], "any", false, false, false, 119), "text", [], "any", false, false, false, 119)) {
                            // line 120
                            echo "                                <div class=\"services_item-info\">";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "widget", [], "any", false, false, false, 120), "text", [], "any", false, false, false, 120), "html", null, true);
                            echo "</div>
                                ";
                        }
                        // line 122
                        echo "                                ";
                        if (twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "widget", [], "any", false, false, false, 122), "link", [], "any", false, false, false, 122)), "title", [], "any", false, false, false, 122)) {
                            // line 123
                            echo "                                <a href=\"";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "widget", [], "any", false, false, false, 123), "link", [], "any", false, false, false, 123)), "url", [], "any", false, false, false, 123), "html", null, true);
                            echo "\" ";
                            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "widget", [], "any", false, false, false, 123), "link", [], "any", false, false, false, 123), "target", [], "any", false, false, false, 123)) {
                                echo "target=\"_blank\" ";
                            }
                            echo " class=\"btn btn-fill\">
                                    ";
                            // line 124
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "widget", [], "any", false, false, false, 124), "link", [], "any", false, false, false, 124)), "title", [], "any", false, false, false, 124), "html", null, true);
                            echo "
                                </a>
                                ";
                        }
                        // line 127
                        echo "                            </div>
                            ";
                    }
                    // line 129
                    echo "                        </div>
                    </div>
                </div>
            </div>
            <!-- services_section -->
        </div>
        ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 136
            echo "    </div>
</section>
";
        }
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/site/sections/servicesCategories.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  417 => 136,  401 => 129,  397 => 127,  391 => 124,  382 => 123,  379 => 122,  373 => 120,  370 => 119,  364 => 117,  362 => 116,  359 => 115,  357 => 114,  354 => 113,  346 => 110,  340 => 108,  337 => 107,  329 => 105,  327 => 104,  323 => 102,  319 => 101,  314 => 98,  310 => 96,  304 => 93,  295 => 92,  292 => 91,  286 => 89,  283 => 88,  277 => 86,  275 => 85,  272 => 84,  270 => 83,  265 => 80,  257 => 77,  251 => 75,  248 => 74,  240 => 72,  238 => 71,  234 => 69,  230 => 68,  218 => 58,  210 => 55,  204 => 53,  201 => 52,  197 => 50,  189 => 47,  186 => 46,  183 => 45,  175 => 42,  172 => 41,  170 => 40,  167 => 39,  165 => 38,  161 => 36,  153 => 33,  150 => 32,  147 => 31,  139 => 29,  131 => 27,  129 => 26,  125 => 24,  121 => 23,  111 => 16,  97 => 12,  86 => 11,  82 => 9,  57 => 6,  54 => 5,  43 => 4,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/site/sections/servicesCategories.htm", "");
    }
}
