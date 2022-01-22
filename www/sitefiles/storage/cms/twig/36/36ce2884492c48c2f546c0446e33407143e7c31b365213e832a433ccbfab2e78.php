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

/* /var/www/sitefiles/themes/diia/layouts/simple.htm */
class __TwigTemplate_544e751089bf834e8c78090a8bc5b058951c683be2ee8ac825d29361176409d0 extends \Twig\Template
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
        echo "<!DOCTYPE html>
<html lang=\"";
        // line 2
        echo KitSoft\MultiLanguage\Twig\Functions::getActiveLocale();
        echo "\">
    <head>
        <meta charset=\"utf-8\">
        <meta name=\"viewport\" content=\"width=device-width, height=device-height, initial-scale=1, minimum-scale=1.0, maximum-scale=1, user-scalable=0\" />

        <title>";
        // line 7
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, false, 7), "title", [], "any", false, false, false, 7), "html", null, true);
        echo " | ";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Дія"]);
        echo "</title>

        <meta name=\"description\" content=\"";
        // line 9
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, false, 9), "meta_description", [], "any", false, false, false, 9), "html", null, true);
        echo "\">
        <meta name=\"title\" content=\"";
        // line 10
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, false, 10), "meta_title", [], "any", false, false, false, 10), "html", null, true);
        echo "\">
        <meta name=\"author\" content=\"\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
        <meta name=\"generator\" content=\"\">

        ";
        // line 15
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/openGraph"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 16
        echo "        ";
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/favicon"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 17
        echo "
        ";
        // line 18
        echo $this->env->getExtension('Cms\Twig\Extension')->assetsFunction('css');
        echo $this->env->getExtension('Cms\Twig\Extension')->displayBlock('styles');
        // line 19
        echo "
        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 20
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/javascript/build/style.css");
        echo "\"/>

        ";
        // line 22
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("googleAnalytics"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 23
        echo "
        ";
        // line 24
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("googleTracker"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 25
        echo "    </head>
    <body>
            
        ";
        // line 28
        echo $this->env->getExtension('Cms\Twig\Extension')->pageFunction();
        // line 29
        echo "            
        <div class=\"d-none\" id=\"page-hash\" data-hash=\"";
        // line 30
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, false, 30), "hash", [], "any", false, false, false, 30), "html", null, true);
        echo "\"></div>
        <script type=\"text/javascript\" src=\"";
        // line 31
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/vendor/jquery-3.4.0/jquery-3.4.0.min.js", 1 => "@framework", 2 => "@framework.extras"]);
        // line 35
        echo "\"></script>

        ";
        // line 37
        echo $this->env->getExtension('Cms\Twig\Extension')->assetsFunction('js');
        echo $this->env->getExtension('Cms\Twig\Extension')->displayBlock('scripts');
        // line 38
        echo "
    </body>
</html>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/layouts/simple.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  124 => 38,  121 => 37,  117 => 35,  115 => 31,  111 => 30,  108 => 29,  106 => 28,  101 => 25,  97 => 24,  94 => 23,  90 => 22,  85 => 20,  82 => 19,  79 => 18,  76 => 17,  71 => 16,  67 => 15,  59 => 10,  55 => 9,  48 => 7,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/layouts/simple.htm", "");
    }
}
