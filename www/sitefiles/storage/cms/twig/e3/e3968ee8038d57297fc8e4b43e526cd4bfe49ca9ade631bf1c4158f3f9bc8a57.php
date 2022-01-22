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

/* /var/www/sitefiles/themes/diia/pages/serviceSubCategory.htm */
class __TwigTemplate_62bf658316ba7204ba856e15f489fce653837b0105cc0af4c6cfc0524a78dd92 extends \Twig\Template
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
        $context["breadcrumbs"] = twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "breadcrumbs", [], "any", false, false, false, 1);
        // line 2
        $context["link"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["serviceCategorySubcategory"] ?? null), "subcategory", [], "any", false, false, false, 2), "fields", [], "any", false, false, false, 2), "link", [], "any", false, false, false, 2);
        // line 3
        echo "
";
        // line 4
        if (twig_length_filter($this->env, ($context["breadcrumbs"] ?? null))) {
            // line 5
            echo "<section>
    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-12\">
                <nav aria-label=\"breadcrumb\">
                    <ul class=\"breadcrumb\">
                        <li class=\"breadcrumb_item\">
                            <a class=\"breadcrumb_item-link\" href=\"";
            // line 12
            echo KitSoft\Core\Twig\UrlFilter::url("/");
            echo "\">";
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Головна"]);
            echo "</a>
                        </li>
                        <li class=\"breadcrumb_item\">
                            <a class=\"breadcrumb_item-link\"
                                href=\"";
            // line 16
            echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, KitSoft\Core\Twig\Functions::getPageByTemplate("services"), "url", [], "any", false, false, false, 16));
            echo "/categories/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["serviceCategorySubcategory"] ?? null), "category", [], "any", false, false, false, 16), "slug", [], "any", false, false, false, 16), "html", null, true);
            echo "\">
                                ";
            // line 17
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["serviceCategorySubcategory"] ?? null), "category", [], "any", false, false, false, 17), "name", [], "any", false, false, false, 17), "html", null, true);
            echo "
                            </a>
                        </li>
                        <li class=\"breadcrumb_item active\">
                            ";
            // line 21
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["serviceCategorySubcategory"] ?? null), "subcategory", [], "any", false, false, false, 21), "name", [], "any", false, false, false, 21), "html", null, true);
            echo "
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>
";
        }
        // line 30
        echo "<section>
    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-12\">
                <h1 class=\"article-level-1\">";
        // line 34
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["serviceCategorySubcategory"] ?? null), "subcategory", [], "any", false, false, false, 34), "name", [], "any", false, false, false, 34), "html", null, true);
        echo "</h1>
            </div>
        </div>
    </div>
</section>

";
        // line 41
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["serviceCategorySubcategory"] ?? null), "subcategory", [], "any", false, false, false, 41), "life_situations", [], "any", false, false, false, 41))) {
            // line 42
            echo "    ";
            if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["serviceCategorySubcategory"] ?? null), "subcategory", [], "any", false, false, false, 42), "life_situations", [], "any", false, false, false, 42)) == 1)) {
                // line 43
                echo "    <section class=\"part_section\">
        <div class=\"container\">
            ";
                // line 45
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["serviceCategorySubcategory"] ?? null), "subcategory", [], "any", false, false, false, 45), "life_situations", [], "any", false, false, false, 45));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 46
                    echo "                <div class=\"row\">
                    <div class=\"col-lg-5\">
                        <div class=\"part_item-content\">
                            <div class=\"part_item-type\">
                                <div class=\"part_item-type-text\">
                                    ";
                    // line 51
                    echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Життєві події та ситуації"]);
                    echo "
                                </div>
                            </div>
                            ";
                    // line 54
                    if (twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 54)) {
                        // line 55
                        echo "                                <div class=\"part_item-title\">";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 55), "html", null, true);
                        echo "</div>
                            ";
                    }
                    // line 57
                    echo "                            ";
                    if (twig_get_attribute($this->env, $this->source, $context["item"], "excerpt", [], "any", false, false, false, 57)) {
                        // line 58
                        echo "                                <div class=\"part_item-short\">";
                        echo twig_get_attribute($this->env, $this->source, $context["item"], "excerpt", [], "any", false, false, false, 58);
                        echo "</div>
                            ";
                    }
                    // line 60
                    echo "                            ";
                    if (twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 60)) {
                        // line 61
                        echo "                            <div class=\"part_item-detail\">
                                <a href=\"";
                        // line 62
                        echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 62));
                        echo "\" class=\"btn btn-fill\">";
                        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Дізнатись більше"]);
                        echo "</a>
                            </div>
                            ";
                    }
                    // line 65
                    echo "                        </div>
                    </div>
                    <div class=\"col-lg-7 d-none d-lg-block\">
                        ";
                    // line 68
                    if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "image", [], "any", false, false, false, 68), "path", [], "any", false, false, false, 68)) {
                        // line 69
                        echo "                            <div class=\"part_item-preview\" style=\"background-image: url('";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "image", [], "any", false, false, false, 69), "path", [], "any", false, false, false, 69), "html", null, true);
                        echo "')\"></div>
                        ";
                    } else {
                        // line 71
                        echo "                            <div class=\"part_item-preview\" style=\"background-image: url('";
                        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/default_photo.png");
                        echo "');\"></div>
                        ";
                    }
                    // line 73
                    echo "                    </div>
                </div>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 76
                echo "        </div>
    </section>
    ";
            } else {
                // line 79
                echo "    <section class=\"part_section-slider\">
        <div class=\"container\">
            <!-- Slider main container -->
            <div class=\"swiper-container swiper_part js-swiper_part\">
                <!-- Additional required wrapper -->
                <div class=\"swiper-wrapper swiper_part-wrapper\">
                <!-- Slides -->
                ";
                // line 86
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["serviceCategorySubcategory"] ?? null), "subcategory", [], "any", false, false, false, 86), "life_situations", [], "any", false, false, false, 86));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 87
                    echo "                    <div class=\"swiper-slide swiper_part-slide\">
                        <div class=\"row\">
                            <div class=\"col-lg-5\">
                                <div class=\"part_item-content\">
                                    <div class=\"part_item-type\">
                                        <div class=\"part_item-type-text\">
                                            ";
                    // line 93
                    echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Життєві події та ситуації"]);
                    echo "
                                        </div>
                                    </div>
                                    ";
                    // line 96
                    if (twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 96)) {
                        // line 97
                        echo "                                        <div class=\"part_item-title\">";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 97), "html", null, true);
                        echo "</div>
                                    ";
                    }
                    // line 99
                    echo "                                    ";
                    if (twig_get_attribute($this->env, $this->source, $context["item"], "excerpt", [], "any", false, false, false, 99)) {
                        // line 100
                        echo "                                        <div class=\"part_item-short\">";
                        echo twig_get_attribute($this->env, $this->source, $context["item"], "excerpt", [], "any", false, false, false, 100);
                        echo "</div>
                                    ";
                    }
                    // line 102
                    echo "                                    ";
                    if (twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 102)) {
                        // line 103
                        echo "                                    <div class=\"part_item-detail\">
                                        <a href=\"";
                        // line 104
                        echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 104));
                        echo "\" class=\"btn btn-fill\">";
                        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Дізнатись більше"]);
                        echo "</a>
                                    </div>
                                    ";
                    }
                    // line 107
                    echo "                                </div>
                            </div>
                            <div class=\"col-lg-7 d-none d-lg-block\">
                                <div class=\"part_item-preview-wrap\">
                                    <div class=\"part_item-type d-lg-none\">
                                        <div class=\"part_item-type-text\">
                                            ";
                    // line 113
                    echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Життєві події та ситуації"]);
                    echo "
                                        </div>
                                    </div>
                                    ";
                    // line 116
                    if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "image", [], "any", false, false, false, 116), "path", [], "any", false, false, false, 116)) {
                        // line 117
                        echo "                                        <div class=\"part_item-preview\" style=\"background-image: url('";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "image", [], "any", false, false, false, 117), "path", [], "any", false, false, false, 117), "html", null, true);
                        echo "')\"></div>
                                    ";
                    } else {
                        // line 119
                        echo "                                        <div class=\"part_item-preview\" style=\"background-image: url('";
                        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/default_photo.png");
                        echo "');\"></div>
                                    ";
                    }
                    // line 121
                    echo "                                </div>
                            </div>
                        </div>
                    </div>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 126
                echo "                </div>
            </div>
            <div class=\"row\">
                <div class=\"col-6\">
                    <!-- If we need navigation buttons -->
                    <div class=\"swiper_part-btn-box\">
                        <div class=\"swiper_part-btn-prev swiper-btn-prev\"></div>
                        <div class=\"swiper_part-btn-next swiper-btn-next\"></div>
                    </div>
                </div>
                <div class=\"col-6 d-none d-lg-block\">
                    <!-- If we need pagination -->
                    <div class=\"swiper-pagination swiper_part-pagination\"></div>
                </div>
            </div>
        </div>
    </section>
    ";
            }
        }
        // line 146
        echo "
<section class=\"service-acc_section\">
    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-12\">
                <div class=\"article-level-2 mt-0\">";
        // line 151
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Послуги"]);
        echo "</div>
            </div>
        \t<div class=\"col-12\">
            \t";
        // line 154
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["serviceCategorySubcategory"] ?? null), "subcategory", [], "any", false, false, false, 154), "children", [], "any", false, false, false, 154));
        foreach ($context['_seq'] as $context["_key"] => $context["subcategory"]) {
            // line 155
            echo "                    <div class=\"service-acc_item\">
                    \t";
            // line 157
            echo "                        <div class=\"service-acc_item-quest js-service-acc_item-quest\">
    \t\t\t\t\t\t";
            // line 158
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["subcategory"], "name", [], "any", false, false, false, 158), "html", null, true);
            echo "
                        </div>
                        <div class=\"collapse service-acc_item-answer\">
                            <div class=\"service-acc_item-link-box\">
                            \t";
            // line 162
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["subcategory"], "services", [], "any", false, false, false, 162));
            foreach ($context['_seq'] as $context["_key"] => $context["service"]) {
                // line 163
                echo "    \t\t\t\t\t\t\t\t<a href=\"";
                echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["service"], "url", [], "any", false, false, false, 163));
                echo "\" class=\"service-acc_item-link\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["service"], "title", [], "any", false, false, false, 163), "html", null, true);
                echo "</a>
    \t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['service'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 165
            echo "                            </div>
                        </div>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['subcategory'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 169
        echo "                ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["serviceCategorySubcategory"] ?? null), "subcategory", [], "any", false, false, false, 169), "services", [], "any", false, false, false, 169));
        foreach ($context['_seq'] as $context["_key"] => $context["service"]) {
            // line 170
            echo "                    <div class=\"service-acc_item\">
                        <a href=\"";
            // line 171
            echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["service"], "url", [], "any", false, false, false, 171));
            echo "\" class=\"service-acc_item-service\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["service"], "title", [], "any", false, false, false, 171), "html", null, true);
            echo "</a>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['service'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 174
        echo "                <div class=\"service-acc_item\">
                    <div class=\"service-acc_item-quest js-service-acc_item-quest\">
                        ";
        // line 176
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Від А до Я"]);
        echo "
                    </div>
                    <div class=\"collapse service-acc_item-answer\">
                        <div class=\"service-acc_item-link-box row\">
                            ";
        // line 180
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["serviceCategorySubcategory"] ?? null), "servicesByLetters", [], "any", false, false, false, 180));
        foreach ($context['_seq'] as $context["letter"] => $context["services"]) {
            // line 181
            echo "                                <div class=\"col-md-6 col-xl-4 services-byletter_item\">
                                    <div class=\"services-byletter_letter\">";
            // line 182
            echo twig_escape_filter($this->env, $context["letter"], "html", null, true);
            echo "</div>
                                    ";
            // line 183
            if (twig_length_filter($this->env, $context["services"])) {
                // line 184
                echo "                                        ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["services"]);
                foreach ($context['_seq'] as $context["_key"] => $context["service"]) {
                    // line 185
                    echo "                                            <div class=\"services-byletter_title\">
                                                <a href=\"";
                    // line 186
                    echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["service"], "url", [], "any", false, false, false, 186));
                    echo "\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["service"], "title", [], "any", false, false, false, 186), "html", null, true);
                    echo "</a>
                                            </div>
                                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['service'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 189
                echo "                                    ";
            }
            // line 190
            echo "                                </div>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['letter'], $context['services'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 192
        echo "                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

";
        // line 211
        echo "
";
        // line 212
        if (((twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(($context["link"] ?? null)), "title", [], "any", false, false, false, 212) && twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(($context["link"] ?? null)), "url", [], "any", false, false, false, 212)) || twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["serviceCategorySubcategory"] ?? null), "subcategory", [], "any", false, false, false, 212), "fields", [], "any", false, false, false, 212), "link_description", [], "any", false, false, false, 212))) {
            // line 213
            echo "    <section>
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-12\">
                    <div class=\"service_not-found\">
                        ";
            // line 218
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["serviceCategorySubcategory"] ?? null), "subcategory", [], "any", false, false, false, 218), "fields", [], "any", false, false, false, 218), "link_description", [], "any", false, false, false, 218)) {
                // line 219
                echo "                        <div class=\"service_not-found-title\">
                            ";
                // line 220
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["serviceCategorySubcategory"] ?? null), "subcategory", [], "any", false, false, false, 220), "fields", [], "any", false, false, false, 220), "link_description", [], "any", false, false, false, 220);
                echo "
                        </div>
                        ";
            }
            // line 223
            echo "                        ";
            if ((twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(($context["link"] ?? null)), "title", [], "any", false, false, false, 223) && twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(($context["link"] ?? null)), "url", [], "any", false, false, false, 223))) {
                // line 224
                echo "                            <div class=\"service_not-found-btn\">
                                <a href=\"";
                // line 225
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(($context["link"] ?? null)), "url", [], "any", false, false, false, 225), "html", null, true);
                echo "\" class=\"btn btn-fill\" ";
                if (twig_get_attribute($this->env, $this->source, ($context["link"] ?? null), "target", [], "any", false, false, false, 225)) {
                    echo "target=\"_blank\"";
                }
                echo ">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(($context["link"] ?? null)), "title", [], "any", false, false, false, 225), "html", null, true);
                echo "</a>
                            </div>
                        ";
            }
            // line 228
            echo "                    </div>
                </div>
            </div>
        </div>
    </section>
";
        }
        // line 234
        echo "
";
        // line 235
        echo $this->env->getExtension('Cms\Twig\Extension')->startBlock('scripts'        );
        // line 236
        echo "\t<script type=\"text/javascript\" src=\"";
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/javascript/build/serviceSubCategory.bundle.js"]);
        echo "\"></script>
";
        // line 235
        echo $this->env->getExtension('Cms\Twig\Extension')->endBlock(true        );
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/pages/serviceSubCategory.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  505 => 235,  500 => 236,  498 => 235,  495 => 234,  487 => 228,  475 => 225,  472 => 224,  469 => 223,  463 => 220,  460 => 219,  458 => 218,  451 => 213,  449 => 212,  446 => 211,  436 => 192,  429 => 190,  426 => 189,  415 => 186,  412 => 185,  407 => 184,  405 => 183,  401 => 182,  398 => 181,  394 => 180,  387 => 176,  383 => 174,  372 => 171,  369 => 170,  364 => 169,  355 => 165,  344 => 163,  340 => 162,  333 => 158,  330 => 157,  327 => 155,  323 => 154,  317 => 151,  310 => 146,  289 => 126,  279 => 121,  273 => 119,  267 => 117,  265 => 116,  259 => 113,  251 => 107,  243 => 104,  240 => 103,  237 => 102,  231 => 100,  228 => 99,  222 => 97,  220 => 96,  214 => 93,  206 => 87,  202 => 86,  193 => 79,  188 => 76,  180 => 73,  174 => 71,  168 => 69,  166 => 68,  161 => 65,  153 => 62,  150 => 61,  147 => 60,  141 => 58,  138 => 57,  132 => 55,  130 => 54,  124 => 51,  117 => 46,  113 => 45,  109 => 43,  106 => 42,  104 => 41,  95 => 34,  89 => 30,  77 => 21,  70 => 17,  64 => 16,  55 => 12,  46 => 5,  44 => 4,  41 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/pages/serviceSubCategory.htm", "");
    }
}
