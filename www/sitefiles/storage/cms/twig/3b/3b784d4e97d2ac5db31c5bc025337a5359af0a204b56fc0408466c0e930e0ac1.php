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

/* /var/www/sitefiles/themes/diia/pages/404.htm */
class __TwigTemplate_bbb4280b47258c123e5da62ba1e4d77bed34f45b4f20fac919779d7a4435283c extends \Twig\Template
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
        echo "
<body class=\"not-found\">
    <div class=\"header_menu\">
        ";
        // line 5
        $context['__cms_partial_params'] = [];
        $context['__cms_partial_params']['items'] = twig_get_attribute($this->env, $this->source, ($context["menu"] ?? null), "menuItems", [], "any", false, false, false, 5)        ;
        $context['__cms_partial_params']['class'] = "header-menu"        ;
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("menu/header"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 6
        echo "        <div class=\"header_sign-mob\">
            <a href=\"";
        // line 7
        echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "registerLink", [], "any", false, false, false, 7)), "url", [], "any", false, false, false, 7));
        echo "\" class=\"btn btn_register\" ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "registerLink", [], "any", false, false, false, 7), "target", [], "any", false, false, false, 7)) {
            echo "target=\"_blank\" ";
        }
        echo ">";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "registerLink", [], "any", false, false, false, 7)), "title", [], "any", false, false, false, 7), "html", null, true);
        echo "</a>
            <a href=\"";
        // line 8
        echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "loginLink", [], "any", false, false, false, 8)), "url", [], "any", false, false, false, 8));
        echo "\" class=\"btn_sign js-btn_sign\" ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "loginLink", [], "any", false, false, false, 8), "target", [], "any", false, false, false, 8)) {
            echo "target=\"_blank\" ";
        }
        echo ">";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "loginLink", [], "any", false, false, false, 8)), "title", [], "any", false, false, false, 8), "html", null, true);
        echo "</a>
        </div>
    </div>
    <div class=\"header_find\">
        <form class=\"form form-search-m\" action=\"";
        // line 12
        echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, KitSoft\Core\Twig\Functions::getPageByTemplate("search"), "url", [], "any", false, false, false, 12));
        echo "\" method=\"GET\" id=\"form-search-mobile\">
            <button class=\"btn form-search-m_btn\"></button>
            <input type=\"search\" name=\"key\" class=\"input form-search-m_input\" placeholder=\"";
        // line 14
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Пошук"]);
        echo "\" autocomplete=\"off\">
            <div class=\"form-search-m_close\"></div>
        </form>
        <div class=\"form-search-m_error\" id=\"form-search-mobile-error\"></div>
    </div>
    <div class=\"header_toggle header_toggle-404\">
        <div class=\"header_toggle-icon js-header_toggle-icon\"></div>
    </div>
    <div class=\"container not-found_content\">
        <div class=\"row\">
            <div class=\"col-12\">
                <a href=\"";
        // line 25
        echo KitSoft\Core\Twig\UrlFilter::url("/");
        echo "\" class=\"not-found_link\">
                    <div class=\"not-found_icon\">
                        <div class=\"not-found_icon-gerb\"></div>
                        <div class=\"not-found_icon-diya\"></div>
                    </div>
                </a>
            </div>
            <div class=\"col-12\">
                <div class=\"not-found_error\">
                    <div class=\"not-found_error-code\">404</div>
                    <div class=\"not-found_error-description\">";
        // line 35
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Такої сторінки не існує"]);
        echo "</div>
                    <div class=\"not-found_error-proposition\">";
        // line 36
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Схоже, це неправильна адреса, або сторінка переїхала"]);
        echo "</div>
                    <a href=\"";
        // line 37
        echo KitSoft\Core\Twig\UrlFilter::url("/");
        echo "\" class=\"btn btn-fill\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["На головну"]);
        echo "</a>
                </div>
            </div>
        </div>
    </div>
    <div class=\"overlay-full-screen\"></div>
</body>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/pages/404.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  116 => 37,  112 => 36,  108 => 35,  95 => 25,  81 => 14,  76 => 12,  63 => 8,  53 => 7,  50 => 6,  44 => 5,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/pages/404.htm", "");
    }
}
