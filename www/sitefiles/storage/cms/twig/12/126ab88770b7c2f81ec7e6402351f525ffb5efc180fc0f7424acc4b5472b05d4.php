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

/* /var/www/sitefiles/themes/diia/partials/site/thinHeader.htm */
class __TwigTemplate_1186b67066891e9fbf13132ce614764cb1a6db9185cb33954300b3e0c1ec0c61 extends \Twig\Template
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
<header id=\"layout-header\" class=\"header-sm\">
\t<div class=\"header-sm_toggle\">
\t\t<a href=\"";
        // line 6
        echo KitSoft\Core\Twig\UrlFilter::url(url("/"));
        echo "\" class=\"header-sm_logo\" title=\"На головну сторінку\">
            <div class=\"header-sm_logo-gerb\"></div>
            <div class=\"header-sm_logo-diya\"></div>
        </a>
        <div class=\"header_toggle-icon js-header_toggle-icon\"></div>
    </div>
    ";
        // line 12
        $context['__cms_partial_params'] = [];
        $context['__cms_partial_params']['items'] = twig_get_attribute($this->env, $this->source, ($context["menu"] ?? null), "menuItems", [], "any", false, false, false, 12)        ;
        $context['__cms_partial_params']['class'] = "header-menu"        ;
        $context['__cms_partial_params']['header'] = ($context["header"] ?? null)        ;
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("menu/header_pc_inner"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 13
        echo "    <div class=\"header_menu\">
        ";
        // line 14
        $context['__cms_partial_params'] = [];
        $context['__cms_partial_params']['items'] = twig_get_attribute($this->env, $this->source, ($context["menu"] ?? null), "menuItems", [], "any", false, false, false, 14)        ;
        $context['__cms_partial_params']['class'] = "header-menu"        ;
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("menu/header"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 15
        echo "        <div class=\"header_sign-wrap\">
            <div class=\"header_sign-mob\" id=\"header_sign-mob\">
                <a href=\"";
        // line 17
        echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "registerLink", [], "any", false, false, false, 17)), "url", [], "any", false, false, false, 17));
        echo "\" class=\"btn btn_register\" ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "registerLink", [], "any", false, false, false, 17), "target", [], "any", false, false, false, 17)) {
            echo "target=\"_blank\"";
        }
        echo ">";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "registerLink", [], "any", false, false, false, 17)), "title", [], "any", false, false, false, 17), "html", null, true);
        echo "</a>
                <a href=\"";
        // line 18
        echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "loginLink", [], "any", false, false, false, 18)), "url", [], "any", false, false, false, 18));
        echo "\" class=\"btn_sign js-btn_sign\" ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "loginLink", [], "any", false, false, false, 18), "target", [], "any", false, false, false, 18)) {
            echo "target=\"_blank\"";
        }
        echo ">";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "loginLink", [], "any", false, false, false, 18)), "title", [], "any", false, false, false, 18), "html", null, true);
        echo "</a>
            </div>
            <div class=\"header_sign-mob header_sign-mob-auth\" id=\"header_sign-mob-auth\">
                <a href=\"";
        // line 21
        echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "loginLink", [], "any", false, false, false, 21)), "url", [], "any", false, false, false, 21));
        echo "\" class=\"btn_sign-auth js-btn_sign-auth\" ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "loginLink", [], "any", false, false, false, 21), "target", [], "any", false, false, false, 21)) {
            echo "target=\"_blank\"";
        }
        echo "></a>
            </div>
        </div>
    </div>
    <div class=\"header_find\">
        <form class=\"form form-search-m\" action=\"";
        // line 26
        echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, KitSoft\Core\Twig\Functions::getPageByTemplate("search"), "url", [], "any", false, false, false, 26));
        echo "\" method=\"GET\" id=\"form-search-mobile\">
            <button class=\"btn form-search-m_btn\"></button>
            <input type=\"search\" name=\"key\" class=\"input form-search-m_input\" placeholder=\"";
        // line 28
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Пошук"]);
        echo "\" autocomplete=\"off\">
            <div class=\"form-search-m_close\"></div>
        </form>
        <div class=\"form-search-m_error\" id=\"form-search-mobile-error\"></div>
    </div>
</header>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/site/thinHeader.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  114 => 28,  109 => 26,  97 => 21,  85 => 18,  75 => 17,  71 => 15,  65 => 14,  62 => 13,  55 => 12,  46 => 6,  41 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/site/thinHeader.htm", "");
    }
}
