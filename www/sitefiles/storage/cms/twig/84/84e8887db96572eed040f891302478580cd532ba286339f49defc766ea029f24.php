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

/* /var/www/sitefiles/themes/diia/partials/site/header.htm */
class __TwigTemplate_cc1200b67cc79eb382c99daa427e879c8ffe38aac502109cfc7047b385dd37ef extends \Twig\Template
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
        $context["header"] = twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Functions::partial("header"), "fields", [], "any", false, false, false, 1);
        // line 2
        $context["socials"] = twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Functions::partial("socials"), "fields", [], "any", false, false, false, 2);
        // line 3
        echo "
<header id=\"layout-header\" class=\"header\">

    ";
        // line 6
        $context['__cms_partial_params'] = [];
        $context['__cms_partial_params']['items'] = twig_get_attribute($this->env, $this->source, ($context["menu"] ?? null), "menuItems", [], "any", false, false, false, 6)        ;
        $context['__cms_partial_params']['class'] = "header-menu"        ;
        $context['__cms_partial_params']['header'] = ($context["header"] ?? null)        ;
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("menu/header_pc_main_page"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 7
        echo "
    <div class=\"header_menu\">
        ";
        // line 9
        $context['__cms_partial_params'] = [];
        $context['__cms_partial_params']['items'] = twig_get_attribute($this->env, $this->source, ($context["menu"] ?? null), "menuItems", [], "any", false, false, false, 9)        ;
        $context['__cms_partial_params']['class'] = "header-menu"        ;
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("menu/header"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 10
        echo "        <div class=\"header_sign-wrap\">
            <div class=\"header_sign-mob\" id=\"header_sign-mob\">
                <a href=\"";
        // line 12
        echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "registerLink", [], "any", false, false, false, 12)), "url", [], "any", false, false, false, 12));
        echo "\" class=\"btn btn_register\" ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "registerLink", [], "any", false, false, false, 12), "target", [], "any", false, false, false, 12)) {
            echo "target=\"_blank\"";
        }
        echo ">";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "registerLink", [], "any", false, false, false, 12)), "title", [], "any", false, false, false, 12), "html", null, true);
        echo "</a>
                <a href=\"";
        // line 13
        echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "loginLink", [], "any", false, false, false, 13)), "url", [], "any", false, false, false, 13));
        echo "\" class=\"btn_sign js-btn_sign\" ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "loginLink", [], "any", false, false, false, 13), "target", [], "any", false, false, false, 13)) {
            echo "target=\"_blank\"";
        }
        echo ">";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "loginLink", [], "any", false, false, false, 13)), "title", [], "any", false, false, false, 13), "html", null, true);
        echo "</a>
            </div>
            <div class=\"header_sign-mob header_sign-mob-auth\" id=\"header_sign-mob-auth\">
                <a href=\"";
        // line 16
        echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "loginLink", [], "any", false, false, false, 16)), "url", [], "any", false, false, false, 16));
        echo "\" class=\"btn_sign-auth js-btn_sign-auth\" ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "loginLink", [], "any", false, false, false, 16), "target", [], "any", false, false, false, 16)) {
            echo "target=\"_blank\"";
        }
        echo "></a>
            </div>
        </div>
    </div>
    <div class=\"header_find\">
        <form class=\"form form-search-m\" action=\"";
        // line 21
        echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, KitSoft\Core\Twig\Functions::getPageByTemplate("search"), "url", [], "any", false, false, false, 21));
        echo "\" method=\"GET\" id=\"form-search-mobile\">
            <button class=\"btn form-search-m_btn\"></button>
            <input type=\"search\" name=\"key\" class=\"input form-search-m_input\" placeholder=\"";
        // line 23
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Пошук"]);
        echo "\" autocomplete=\"off\">
            <div class=\"form-search-m_close\"></div>
        </form>
        <div class=\"form-search-m_error\" id=\"form-search-mobile-error\"></div>
    </div>
    <div class=\"header_bg\">
        <div class=\"header_bg-gradient js-header_bg-gradient\"></div>
        <div class=\"header_toggle\">
            <div class=\"header_toggle-icon js-header_toggle-icon\"></div>
        </div>
        <div class=\"header_content\">
            <div class=\"header_content-box\">
                <a href=\"";
        // line 35
        echo KitSoft\Core\Twig\UrlFilter::url(url("/"));
        echo "\" class=\"header_logo\" title=\"На головну сторінку\">
                    <div class=\"header_logo-gerb\"></div>
                    <div class=\"header_logo-diya\"></div>
                </a>
            </div>
            <div class=\"header_title\">
                ";
        // line 41
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Державні послуги онлайн"]);
        echo "
            </div>
            <form class=\"form form-search\" action=\"";
        // line 43
        echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, KitSoft\Core\Twig\Functions::getPageByTemplate("search"), "url", [], "any", false, false, false, 43));
        echo "\" method=\"GET\" id=\"form-search-site\">
                <div class=\"col-lg-6\">
                    <div class=\"form-group\">
                        <div class=\"form-group_inner\">
                            <label>
                                <input name=\"key\" type=\"search\" placeholder=\"";
        // line 48
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Назва послуги або життєва ситуація"]);
        echo "\" class=\"input form-search_input\" autocomplete=\"off\">
                            </label>
                            <input type=\"submit\" class=\"btn btn_search-main\" value=\"\">
                        </div>
                        <div class=\"form-search_error\" id=\"form-search-site-error\"></div>
                        <div class=\"form-search_text\">
                            ";
        // line 54
        echo twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "searchDescriptions", [], "any", false, false, false, 54);
        echo "
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</header>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/site/header.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  152 => 54,  143 => 48,  135 => 43,  130 => 41,  121 => 35,  106 => 23,  101 => 21,  89 => 16,  77 => 13,  67 => 12,  63 => 10,  57 => 9,  53 => 7,  46 => 6,  41 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/site/header.htm", "");
    }
}
