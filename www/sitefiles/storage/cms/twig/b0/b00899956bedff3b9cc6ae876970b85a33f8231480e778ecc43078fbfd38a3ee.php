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

/* /var/www/sitefiles/themes/diia/layouts/testService.htm */
class __TwigTemplate_ad8b6754038b6e2e7a93fd5f37cddb508b35bd649f180ffd4e23b6aa5db18516 extends \Twig\Template
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
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/vendor/swiper-5.3.0/css/swiper.min.css", 1 => "assets/javascript/build/style.css"]);
        // line 23
        echo "\"/>

        ";
        // line 25
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("googleAnalytics"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 26
        echo "
        ";
        // line 27
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("googleTracker"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 28
        echo "    </head>
    <body>
            
        ";
        // line 31
        echo $this->env->getExtension('Cms\Twig\Extension')->pageFunction();
        // line 32
        echo "            
        <div class=\"d-none\" id=\"page-hash\" data-hash=\"";
        // line 33
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, false, 33), "hash", [], "any", false, false, false, 33), "html", null, true);
        echo "\"></div>
        <script src=\"https://polyfill.io/v3/polyfill.min.js?features=es2015%2Cdefault%2Cblissfuljs\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 35
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/vendor/jquery-3.4.0/jquery-3.4.0.min.js", 1 => "assets/vendor/bootstrap-4.3.1/bootstrap.bundle.min.js", 2 => "@framework", 3 => "@framework.extras"]);
        // line 40
        echo "\"></script>

        ";
        // line 42
        echo $this->env->getExtension('Cms\Twig\Extension')->assetsFunction('js');
        echo $this->env->getExtension('Cms\Twig\Extension')->displayBlock('scripts');
        // line 43
        echo "
    </body>
</html>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/layouts/testService.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  126 => 43,  123 => 42,  119 => 40,  117 => 35,  112 => 33,  109 => 32,  107 => 31,  102 => 28,  98 => 27,  95 => 26,  91 => 25,  87 => 23,  85 => 20,  82 => 19,  79 => 18,  76 => 17,  71 => 16,  67 => 15,  59 => 10,  55 => 9,  48 => 7,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/layouts/testService.htm", "");
    }
}
