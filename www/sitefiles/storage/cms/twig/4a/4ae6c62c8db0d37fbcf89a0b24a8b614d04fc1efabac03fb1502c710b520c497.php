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

/* /var/www/sitefiles/themes/diia/partials/site/footer.htm */
class __TwigTemplate_f89f481696ad5da3b3a8ecef3a5ea28dc7cb0c0f5e656066c6f08a6210123dcb extends \Twig\Template
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
        $context["footer"] = twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Functions::partial("footer"), "fields", [], "any", false, false, false, 1);
        // line 2
        $context["socials"] = twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Functions::partial("socials"), "fields", [], "any", false, false, false, 2);
        // line 3
        echo "
<footer id=\"layout-footer\" class=\"footer\">
    <div class=\"container footer_top\">
        <div class=\"row\">
        ";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["servicesCategoriesFooter"] ?? null), "categories", [], "any", false, false, false, 7));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["category"], "subcategoriesTree", [], "any", false, false, false, 7))) {
                // line 8
                echo "            <div class=\"col-sm-6\">
                <div class=\"row\">
                    <div class=\"services-short_item-title js-services-short_item-title\">";
                // line 10
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 10), "html", null, true);
                echo "</div>
                    ";
                // line 11
                if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["category"], "subcategoriesTree", [], "any", false, false, false, 11))) {
                    // line 12
                    echo "                    <div class=\"services-short_item-box\">
                        ";
                    // line 13
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["category"], "subcategoriesTree", [], "any", false, false, false, 13));
                    foreach ($context['_seq'] as $context["_key"] => $context["subcategory"]) {
                        // line 14
                        echo "                            <div class=\"services-short_item\">
                                <a href=\"";
                        // line 15
                        echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["subcategory"], "getUrl", [0 => $context["category"]], "method", false, false, false, 15));
                        echo "\" class=\"services-short_item-link\">";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["subcategory"], "name", [], "any", false, false, false, 15), "html", null, true);
                        echo "</a>
                            </div>
                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['subcategory'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 18
                    echo "                    </div>
                    ";
                }
                // line 20
                echo "                </div>
            </div>
        ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 23
        echo "        </div>
    </div>
    <hr class=\"footer_hr\">
    <div class=\"footer_bottom\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-md-6 col-lg-9\">
                    ";
        // line 30
        $context['__cms_partial_params'] = [];
        $context['__cms_partial_params']['items'] = twig_get_attribute($this->env, $this->source, ($context["menu"] ?? null), "menuItems", [], "any", false, false, false, 30)        ;
        $context['__cms_partial_params']['class'] = "footer-menu"        ;
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("menu/footer"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 31
        echo "                </div>
                <div class=\"col-md-6 col-lg-3 socials_footer-wrap\">
\t\t\t\t    ";
        // line 33
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["socials"] ?? null), "items", [], "any", false, false, false, 33))) {
            // line 34
            echo "\t\t\t\t    \t<div class=\"socials_footer-title\">";
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Слідкуй за нами тут"]);
            echo ":</div>
\t\t\t\t\t    <ul class=\"socials socials_footer fa-white\">
\t\t\t\t\t    \t";
            // line 36
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["socials"] ?? null), "items", [], "any", false, false, false, 36));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 37
                echo "\t\t\t\t\t\t    \t<li>
\t\t                            <a href=\"";
                // line 38
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 38), "html", null, true);
                echo "\" target=\"_blank\" rel=\"nofollow\">
\t\t                                <i class=\"fa fa-";
                // line 39
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "icon", [], "any", false, false, false, 39), "html", null, true);
                echo "\"></i>
\t\t                            </a>
\t\t                        </li>
\t\t\t\t\t        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 43
            echo "\t\t\t\t\t        ";
            // line 44
            echo "\t\t\t\t\t    </ul>
\t\t\t\t    ";
        }
        // line 46
        echo "                </div>
                <div class=\"col-lg-6\">
                    <div class=\"dev-company\">
                        <div class=\"dev-company_icon\">
                            <div class=\"dev-company_icon-item dev-company_icon-gerb\"></div>
                            <div class=\"dev-company_icon-item dev-company_icon-diya\"></div>
                        </div>
                        <div class=\"dev-company_text\">
                            <p>diia.gov.ua</p>
                            <p>2019 - ";
        // line 55
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
        echo ". Всі права захищені.</p>
                        </div>
                    </div>
                </div>
                <div class=\"col-lg-6\">
                    <div class=\"store\">
                        <a href=\"https://apps.apple.com/us/app/дія/id1489717872\" title=\"Завантажити з ‎App Store\" class=\"store-apple\" target=\"_blank\" rel=\"noopener noreferrer\"></a>
                        <a href=\"https://play.google.com/store/apps/details?id=ua.gov.diia.app\" title=\"Завантажити з ‎Google Play‎\" class=\"store-google\" target=\"_blank\" rel=\"noopener noreferrer\"></a>
                        <a href=\"https://bit.ly/2A4TxzB\"
                           title=\"Завантажити з HUAWEI AppGallery\"
                           class=\"store-app-gallery\"
                           target=\"_blank\"
                           rel=\"noopener noreferrer\"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/site/footer.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  161 => 55,  150 => 46,  146 => 44,  144 => 43,  134 => 39,  130 => 38,  127 => 37,  123 => 36,  117 => 34,  115 => 33,  111 => 31,  105 => 30,  96 => 23,  87 => 20,  83 => 18,  72 => 15,  69 => 14,  65 => 13,  62 => 12,  60 => 11,  56 => 10,  52 => 8,  47 => 7,  41 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/site/footer.htm", "");
    }
}
